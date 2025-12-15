<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use Carbon\Carbon;
use App\Models\Account;
use Livewire\Component;
use App\Models\TimeSlot;
use App\Models\Appointment;
use Livewire\WithFileUploads;
use App\Models\ConsultationType;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\AppointmentConfirmation;
use App\Mail\AdminAppointmentNotification;

class Meeting extends Component
{
    use WithFileUploads;

    // --- State Management ---
    public int $currentStep = 1;

    // --- Data Properties ---
    public $consultationTypes;
    public $account = null;
    public $calendarDays = [];
    public $bookedDates = [];
    public $availableTimeSlots = [];

    // --- User Selections ---
    public $selectedConsultationType = null;
    public $selectedDate = null;
    public $selectedTimeSlot = null;

    // --- Form Inputs ---
    public $clientName = '';
    public $clientEmail = '';
    public $clientPhone = '';
    public $contactMethod = '';
    public $paymentProof;
    public $notes = '';

    // --- Calendar State ---
    public $currentMonth;
    public $currentYear;

    public function mount()
    {
        $now = Carbon::now();
        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;

        $this->consultationTypes = ConsultationType::active()->get();
        $this->account = Account::where('is_active', true)->latest()->first();
        $this->generateCalendar();

        $this->loadBookedDates();
    }

    // =================================================================
    // STEP NAVIGATION
    // =================================================================

    public function goToStep(int $step)
    {
        // On ne peut pas sauter des étapes en avant
        if ($step > $this->currentStep && !$this->canProceedToStep($step)) {
            return;
        }
        $this->currentStep = $step;
    }

    public function nextStep()
    {
        if ($this->canProceedToStep($this->currentStep + 1)) {
            $this->currentStep++;
        }
    }

    protected function canProceedToStep(int $targetStep): bool
    {
        return match ($targetStep) {
            2 => !empty($this->selectedConsultationType),
            3 => !empty($this->selectedDate) && !empty($this->selectedTimeSlot),
            default => true,
        };
    }

    // =================================================================
    // COMPUTED PROPERTIES (for clean UI)
    // =================================================================

    #[Computed]
    public function selectedConsultationDetails()
    {
        if (!$this->selectedConsultationType) {
            return null;
        }
        return ConsultationType::find($this->selectedConsultationType);
    }

    #[Computed]
    public function selectedSlotDetails()
    {
        if (!$this->selectedTimeSlot) {
            return null;
        }
        return TimeSlot::find($this->selectedTimeSlot);
    }

    // =================================================================
    // ACTIONS & LOGIC
    // =================================================================

    public function selectConsultationType($typeId)
    {
        $this->selectedConsultationType = $typeId;
        $this->nextStep();
    }

    public function selectDate($date)
    {
        if (!$date)
            return;
        $this->selectedDate = $date;
        $this->selectedTimeSlot = null; // Réinitialiser le créneau si la date change
        $this->loadAvailableTimeSlots();
    }

    public function selectTimeSlot($slotId)
    {
        $this->selectedTimeSlot = $slotId;
        $this->nextStep();
    }

    public function bookAppointment()
    {
        // Validation finale
        $validated = $this->validate([
            'clientName' => 'required|min:3',
            'clientEmail' => 'required|email',
            'clientPhone' => 'required',
            'contactMethod' => 'required|in:email,whatsapp,telephone',
            'paymentProof' => 'nullable|file|max:10240', // 10MB - optional
            
        ]);

       

        // Vérifier que l'utilisateur a sélectionné un créneau et une date
        $slot = $this->selectedSlotDetails();
        if (!$slot || !$this->selectedDate) {
            session()->flash('error', 'Veuillez sélectionner une date et un créneau valides.');
            return;
        }

        // Stocker la preuve de paiement si fournie (avant la transaction). En cas d'échec de la transaction
        // on tentera de supprimer le fichier pour éviter des fichiers orphelins.
        $paymentProofPath = null;
        if ($this->paymentProof) {
            try {
                $paymentProofPath = $this->paymentProof->store('payment_proofs', 'public');
            } catch (\Throwable $e) {
                Log::error('Payment proof upload failed: ' . $e->getMessage());
                session()->flash('error', 'Impossible d\'uploader la preuve de paiement. Veuillez réessayer.');
                return;
            }
        }

        // Construire les bornes du créneau en Carbon pour vérifications
        $slotStart = Carbon::parse($this->selectedDate . ' ' . $slot->start_time);
        $slotEnd = Carbon::parse($this->selectedDate . ' ' . $slot->end_time);

        try {
            DB::beginTransaction();

            // Re-vérifier qu'aucun rendez-vous ne chevauche ce créneau (concurrence possible)
            $conflict = Appointment::where('appointment_date', $this->selectedDate)
                ->where(function ($q) use ($slotStart, $slotEnd) {
                    $q->where(function ($qq) use ($slotStart, $slotEnd) {
                        $qq->where('start_time', '<', $slotEnd)
                           ->where('end_time', '>', $slotStart);
                    });
                })
                ->exists();

            if ($conflict) {
                DB::rollBack();
                // supprimer la preuve si on l'avait uploadée
                if ($paymentProofPath && Storage::disk('public')->exists($paymentProofPath)) {
                    Storage::disk('public')->delete($paymentProofPath);
                }
                session()->flash('error', 'Désolé, ce créneau vient d\'être réservé. Veuillez choisir un autre créneau.');
                return;
            }

            // Créer le rendez-vous
            $appointment = Appointment::create([
                'client_name' => $this->clientName,
                'client_email' => $this->clientEmail,
                'client_phone' => $this->clientPhone,
                'appointment_date' => $this->selectedDate,
                'start_time' => $slotStart,
                'end_time' => $slotEnd,
                'notes' => $this->notes,
                'payment_proof' => $paymentProofPath,
                'payment_method' => 'virement_bancaire',
                'status' => 'booked',
                'contact_method' => $this->contactMethod,
                'consultation_type_id' => $this->selectedConsultationType,
            ]);

            if (!$appointment) {
                DB::rollBack();
                if ($paymentProofPath && Storage::disk('public')->exists($paymentProofPath)) {
                    Storage::disk('public')->delete($paymentProofPath);
                }
                session()->flash('error', 'Une erreur est survenue lors de la réservation. Veuillez réessayer.');
                return;
            }

            DB::commit();

            // Envoyer les emails après commit pour éviter d'envoyer des mails pour une transaction rollbackée
            try {
                Mail::mailer('contact')->to($this->clientEmail)->send(new AppointmentConfirmation($appointment, $slot, $this->account));
            } catch (\Throwable $e) {
                Log::error('Failed to send confirmation email to client: ' . $e->getMessage());
                session()->flash('warning', 'Votre rendez-vous est confirmé mais la confirmation par e-mail n\'a pas pu être envoyée.');
            }

            try {
                Mail::mailer('contact')->to(['contact@auxane-voyance.com', Setting::get('email') ?? ''])->send(new AdminAppointmentNotification($appointment, $slot, $this->account));
            } catch (\Throwable $e) {
                Log::error('Failed to send admin notification email: ' . $e->getMessage());
            }

            // Afficher une page de succès
            session()->flash('success_message', 'Votre rendez-vous a été confirmé !');
            $this->currentStep = 4; // Aller à l'étape de confirmation

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error booking appointment: ' . $th->getMessage());
            // supprimer la preuve si on l'avait uploadée
            if ($paymentProofPath && Storage::disk('public')->exists($paymentProofPath)) {
                Storage::disk('public')->delete($paymentProofPath);
            }
            session()->flash('error', 'Une erreur serveur est survenue lors de la réservation. Veuillez réessayer plus tard.');
            return;
        }

    }


    // --- Fonctions utilitaires du calendrier (inchangées) ---

    public function generateCalendar()
    {
        $this->calendarDays = [];
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $daysInMonth = $date->daysInMonth;

        // Ajouter des jours vides pour aligner correctement le premier jour du mois
        // Utiliser isoWeekday pour démarrer la grille sur Lundi = 1
        $firstDayIso = $date->isoWeekday();
        for ($i = 1; $i < $firstDayIso; $i++) {
            $this->calendarDays[] = [
                'day' => null,
                'date' => null,
                'isCurrentMonth' => false,
                'isToday' => false,
                'isPast' => true,
                'isBooked' => false,
            ];
        }

        // Ajouter les jours du mois
        $today = Carbon::today();
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = Carbon::createFromDate($this->currentYear, $this->currentMonth, $day);
            $this->calendarDays[] = [
                'day' => $day,
                'date' => $currentDate->format('Y-m-d'),
                'isCurrentMonth' => true,
                'isToday' => $currentDate->isSameDay($today),
                'isPast' => $currentDate->isPast(),
                'isBooked' => in_array($currentDate->format('Y-m-d'), $this->bookedDates),
            ];
        }
    }

    public function loadAvailableTimeSlots()
    {
        if (!$this->selectedDate)
            return;
        $selectedCarbDate = Carbon::parse($this->selectedDate);
        // Utiliser isoWeekday: 1 (lundi) .. 7 (dimanche) pour correspondre au seeder
        $dayOfWeek = $selectedCarbDate->isoWeekday();
        $timeSlots = TimeSlot::where('day_of_week', $dayOfWeek)->where('is_available', true)->get();
        $bookedAppointments = Appointment::where('appointment_date', $this->selectedDate)->get();
        $this->availableTimeSlots = $timeSlots->filter(function ($slot) use ($bookedAppointments) {
            foreach ($bookedAppointments as $appointment) {
                $slotStart = Carbon::parse($this->selectedDate . ' ' . $slot->start_time);
                $slotEnd = Carbon::parse($this->selectedDate . ' ' . $slot->end_time);
                $appointmentStart = Carbon::parse($appointment->start_time);
                $appointmentEnd = Carbon::parse($appointment->end_time);
                if ($slotStart < $appointmentEnd && $slotEnd > $appointmentStart) {
                    return false;
                }
            }
            return true;
        })->toArray();
    }

    public function loadBookedDates()
    {
        $startDate = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $endDate = Carbon::createFromDate($this->currentYear, $this->currentMonth, $startDate->daysInMonth);

        $this->bookedDates = [];

        // Parcourir chaque jour du mois
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            // Utiliser isoWeekday pour obtenir 1..7
            $dayOfWeek = $currentDate->isoWeekday();

            // Obtenir tous les créneaux disponibles pour ce jour de semaine
            $allTimeSlots = TimeSlot::where('day_of_week', $dayOfWeek)
                ->where('is_available', true)
                ->get();

            if ($allTimeSlots->isEmpty()) {
                // Si aucun créneau n'est configuré pour ce jour de semaine
                $this->bookedDates[] = $currentDate->format('Y-m-d');
            } else {
                // Vérifier les rendez-vous existants pour cette date
                $bookedSlots = Appointment::where('appointment_date', $currentDate->format('Y-m-d'))
                    ->get(['start_time', 'end_time']);

                // Compter les créneaux encore disponibles
                $availableSlots = $allTimeSlots->filter(function ($slot) use ($bookedSlots, $currentDate) {
                    // construire intervalles pour le créneau (date courante + time)
                    $slotStart = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $slot->start_time);
                    $slotEnd = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $slot->end_time);

                    foreach ($bookedSlots as $bookedSlot) {
                        $bookedStart = Carbon::parse($bookedSlot->start_time);
                        $bookedEnd = Carbon::parse($bookedSlot->end_time);

                        // conflit si les intervalles se chevauchent
                        if ($slotStart < $bookedEnd && $slotEnd > $bookedStart) {
                            return false;
                        }
                    }
                    return true;
                });

                // Si tous les créneaux sont réservés, marquer cette date comme réservée
                if ($availableSlots->isEmpty()) {
                    $this->bookedDates[] = $currentDate->format('Y-m-d');
                }
            }

            $currentDate->addDay();
        }

        $this->generateCalendar();
    }

    public function nextMonth()
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->loadBookedDates();
    }

    public function prevMonth()
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->loadBookedDates();
    }
  

    public function render()
    {
        return view('livewire.pages.meeting');
    }
}

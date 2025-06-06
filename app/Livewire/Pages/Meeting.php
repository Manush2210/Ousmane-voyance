<?php

namespace App\Livewire\Pages;

use App\Models\Account;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Mail\AppointmentConfirmation;
use App\Mail\AdminAppointmentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PaymentMethod;
use App\Models\ConsultationType;

class Meeting extends Component
{
    use WithFileUploads; // Ajouter cette ligne pour gérer l'upload de fichiers

    public $account = null;
    public $currentMonth;
    public $currentYear;
    public $selectedDate = null;
    public $availableTimeSlots = [];
    public $selectedTimeSlot = null;
    public $selectedConsultationType = null; // Ajout du type de consultation sélectionné

    // Informations client
    public $clientName = '';
    public $clientEmail = '';
    public $clientPhone = '';
    public $notes = '';
    public $paymentProof; // Nouveau champ pour le fichier
    public $contactMethod = ''; // Nouveau champ pour la méthode de contact
    public $phone_confirm = ''; // Improved honeypot field - should remain empty

    public $calendarDays = [];
    public $bookedDates = [];

    public $paymentMethods;
    public $selectedPaymentMethod = null;

    public $consultationTypes; // Types de consultation disponibles

    public function mount()
    {
        $this->paymentMethods = collect();
        $this->consultationTypes = collect();

        $now = Carbon::now();
        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;
        $this->generateCalendar();
        $this->loadBookedDates();
        $this->account = Account::where('is_active', true)->latest()->first();
        $this->loadPaymentMethods();
        $this->loadConsultationTypes();

        // Store the timestamp when the form is loaded
        session(['meeting_form_time' => time()]);
    }

    public function generateCalendar()
    {
        $this->calendarDays = [];
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $daysInMonth = $date->daysInMonth;

        // Ajouter des jours vides pour aligner correctement le premier jour du mois
        $firstDayOfWeek = $date->dayOfWeek;
        for ($i = 1; $i < $firstDayOfWeek; $i++) {
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

    public function loadBookedDates()
    {
        $startDate = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $endDate = Carbon::createFromDate($this->currentYear, $this->currentMonth, $startDate->daysInMonth);

        $this->bookedDates = [];

        // Parcourir chaque jour du mois
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $dayOfWeek = $currentDate->dayOfWeek;

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
                $availableSlots = $allTimeSlots->filter(function ($slot) use ($bookedSlots) {
                    foreach ($bookedSlots as $bookedSlot) {
                        if ($slot->start_time >= $bookedSlot->start_time && $slot->start_time < $bookedSlot->end_time) {
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

    public function selectDate($date)
    {
        //dd($date);
        if (!$date) return;

        $this->selectedDate = $date;
        $this->loadAvailableTimeSlots();
       // dd($this->availableTimeSlots);
    }

    public function loadAvailableTimeSlots()
    {
        if (!$this->selectedDate) return;

        $selectedDate = Carbon::parse($this->selectedDate);
        $dayOfWeek = $selectedDate->dayOfWeek;

        // Chercher les créneaux disponibles pour ce jour de la semaine
        $timeSlots = TimeSlot::where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->get();

        // Vérifier quels créneaux sont déjà réservés
        // Important: récupérer les rendez-vous pour cette date
        $bookedAppointments = Appointment::where('appointment_date', $this->selectedDate)
            ->get();

        // Filtrer les créneaux disponibles
        $this->availableTimeSlots = $timeSlots->filter(function ($slot) use ($bookedAppointments) {
            // Pour chaque rendez-vous existant
            foreach ($bookedAppointments as $appointment) {
                // Convertir les chaînes d'heures en objets Carbon pour comparaison correcte
                $slotStart = Carbon::parse($this->selectedDate . ' ' . $slot->start_time);
                $slotEnd = Carbon::parse($this->selectedDate . ' ' . $slot->end_time);

                $appointmentStart = Carbon::parse($appointment->start_time);
                $appointmentEnd = Carbon::parse($appointment->end_time);

                // Si le créneau chevauche un rendez-vous existant, il n'est pas disponible
                if ($slotStart < $appointmentEnd && $slotEnd > $appointmentStart) {
                    return false;
                }
            }
            return true;
        })->toArray();
    }

    public function selectTimeSlot($slotId)
    {
        $this->selectedTimeSlot = $slotId;
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

    public function bookAppointment()
    {
        // More effective honeypot check - if filled, silently fail
        if (!empty($this->phone_confirm)) {
            // Log the bot attempt (optional)
            \Illuminate\Support\Facades\Log::info('Bot submission detected in meeting form - Honeypot field was filled');

            // Pretend success but don't process anything
            session()->flash('message', 'Rendez-vous réservé avec succès! Un email de confirmation vous a été envoyé.');
            return;
        }

        // Add a timing check (bots usually submit forms too quickly)
        $timestamp = session('meeting_form_time');
        $now = time();

        // If the form was submitted less than 3 seconds after page load, likely a bot
        if (!$timestamp || ($now - $timestamp < 3)) {
            session()->flash('message', 'Rendez-vous réservé avec succès! Un email de confirmation vous a été envoyé.');
            return;
        }

        $this->validate([
            'clientName' => 'required|min:3',
            'clientEmail' => 'required|email',
            'clientPhone' => 'required',
            'selectedDate' => 'required|date',
            'selectedTimeSlot' => 'required',
            'paymentProof' => 'required|file|max:10240', // 10MB max
            'contactMethod' => 'required|in:email,whatsapp,telephone',
            'selectedPaymentMethod' => 'required|string',
            'selectedConsultationType' => 'required|exists:consultation_types,id',
        ], [
            'clientName.required' => 'Veuillez saisir votre nom',
            'clientName.min' => 'Votre nom doit contenir au moins 3 caractères',
            'clientEmail.required' => 'Veuillez saisir votre email',
            'clientEmail.email' => 'Veuillez saisir une adresse email valide',
            'clientPhone.required' => 'Veuillez saisir votre numéro de téléphone',
            'selectedDate.required' => 'Veuillez sélectionner une date',
            'selectedDate.date' => 'Format de date invalide',
            'selectedTimeSlot.required' => 'Veuillez sélectionner un créneau horaire',
            'paymentProof.required' => 'Veuillez joindre une preuve de paiement',
            'paymentProof.file' => 'Le document doit être un fichier valide',
            'paymentProof.max' => 'La taille du fichier ne doit pas dépasser 10Mo',
            'contactMethod.required' => 'Veuillez sélectionner une méthode de contact',
            'contactMethod.in' => 'Méthode de contact invalide',
            'selectedPaymentMethod.required' => 'Veuillez sélectionner un moyen de paiement',
            'selectedConsultationType.required' => 'Veuillez sélectionner un type de consultation',
            'selectedConsultationType.exists' => 'Le type de consultation sélectionné n\'est pas valide',
        ]);

        $slot = TimeSlot::find($this->selectedTimeSlot);

        // Chemin de stockage du fichier
        $paymentProofPath = null;
        if ($this->paymentProof) {
            $paymentProofPath = $this->paymentProof->store('payment_proofs', 'public');
        }

        // Création du rendez-vous
        $appointment = Appointment::create([
            'client_name' => $this->clientName,
            'client_email' => $this->clientEmail,
            'client_phone' => $this->clientPhone,
            'appointment_date' => $this->selectedDate,
            'start_time' => Carbon::parse($this->selectedDate . ' ' . $slot->start_time),
            'end_time' => Carbon::parse($this->selectedDate . ' ' . $slot->end_time),
            'notes' => $this->notes,
            'payment_proof' => $paymentProofPath,
            'payment_method' => $this->selectedPaymentMethod,
            'status' => 'booked',
            'contact_method' => $this->contactMethod,
            'consultation_type_id' => $this->selectedConsultationType,
        ]);

        // Envoyer un email de confirmation au client
        Mail::to($this->clientEmail)
            ->send(new AppointmentConfirmation($appointment, $slot));

        // Envoyer un email de notification à l'admin
        Mail::to('contact@voyance-spirituelle-expert.com')
            ->send(new AdminAppointmentNotification($appointment, $slot));
        $this->dispatch('showToast', [
            'message' => 'Rendez-vous réservé avec succès! Un email de confirmation vous a été envoyé.',
        ]);

        session()->flash('message', 'Rendez-vous réservé avec succès! Un email de confirmation vous a été envoyé.');
        $this->loadBookedDates();
        $this->loadAvailableTimeSlots();
    }

    public function loadPaymentMethods()
    {
        $this->paymentMethods = PaymentMethod::where('is_active', true)->get();

        // Si au moins une méthode est active, sélectionner la première par défaut
        if ($this->paymentMethods->isNotEmpty()) {
            $this->selectedPaymentMethod = $this->paymentMethods->first()->code;
        }
    }

    /**
     * Charger les types de consultation disponibles
     */
    public function loadConsultationTypes()
    {
        $this->consultationTypes = ConsultationType::active()->get();

        // Sélectionner le premier type par défaut s'il y en a
        if ($this->consultationTypes->isNotEmpty() && empty($this->selectedConsultationType)) {
            $this->selectedConsultationType = $this->consultationTypes->first()->id;
        }
    }

    /**
     * Sélectionner manuellement un type de consultation
     */
    public function selectConsultationType($typeId)
    {
        $this->selectedConsultationType = $typeId;
    }

    public function render()
    {
        return view('livewire.pages.meeting');
    }
}

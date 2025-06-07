<?php

namespace App\Mail;

use App\Models\Appointment;
use App\Models\TimeSlot;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAppointmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $timeSlot;

    public function __construct(Appointment $appointment, TimeSlot $timeSlot)
    {
        $this->appointment = $appointment->load('consultationType');
        $this->timeSlot = $timeSlot;
    }

    public function build()
    {
        return $this->markdown('emails.admin-appointment-notification')
                    ->subject('Nouvelle réservation de consultation - Voyance Spirituelle Expert')
                    ->attachFromStorageDisk('public', $this->appointment->payment_proof);
    }
}

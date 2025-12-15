<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use Livewire\Component;
use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $email_confirm = ''; // Improved honeypot field - should remain empty

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:5',
    ];

    protected $messages = [
        'name.required' => 'Le nom est requis',
        'name.min' => 'Le nom doit contenir au moins 2 caractères',
        'email.required' => 'L\'email est requis',
        'email.email' => 'L\'email doit être une adresse valide',
        'message.required' => 'Le message est requis',
        'message.min' => 'Le message doit contenir au moins 10 caractères',
    ];



    public function submit()
    {
        $validate = $this->validate();

        try {
            Log::info('Sending contact email', [
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ]);

            if ($validate) {
                Mail::mailer('contact')->to(['contact@auxane-voyance.com', Setting::get('email') ?? ''])
                    ->send(new ContactMailable($this->name, $this->email, $this->message));
            }


            // Reset form fields
            $this->name = '';
            $this->email = '';
            $this->message = '';
            $this->email_confirm = '';

            session()->flash('success', 'Votre message a été envoyé avec succès !');
        } catch (\Exception $e) {
            Log::error('Error sending contact email: ' . $e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'envoi du message.');
        }
    }

    public function render()
    {
        // Store the timestamp when the form is loaded
        // session(['form_time' => time()]);

        return view('livewire.pages.contact');
    }
}

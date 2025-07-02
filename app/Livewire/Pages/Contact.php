<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class Contact extends Component
{
    public $turnstileToken = '';
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

    protected function verifyTurnstile()
    {
        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('services.cloudflare.secret_key'),
            'response' => $this->turnstileToken,
            'remoteip' => request()->ip(),
        ]);

        $result = $response->json();
        // dd($result);

        return $result['success'] ?? false;
    }

    public function submit()
    {
        // More effective honeypot check - if filled, silently fail
        $turnstileToken = $this->turnstileToken;
        // dd($turnstileToken);

        if (!$turnstileToken) {
            session()->flash('error', 'La vérification de sécurité a échoué. Veuillez réessayer.');
            return;
        }

        // Vérifier le token Turnstile
        if (!$this->verifyTurnstile()) {
            session()->flash('error', 'La vérification de sécurité a échoué. Veuillez réessayer.');
            return;
        }
        // Add a timing check (bots usually submit forms too quickly)
        $timestamp = session('form_time');
        $now = time();

        // If the form was submitted less than 2 seconds after page load, likely a bot
        if (!$timestamp || ($now - $timestamp < 2)) {
            session()->flash('success', 'Votre message a été envoyé avec succès !');
            return;
        }

        $this->validate();

        try {
            // Envoi du mail directement sans utiliser de Mailable
            Mail::send('emails.contact-form', [
                'name' => $this->name,
                'email' => $this->email,
                'messageContent' => $this->message
            ], function ($m) {
                $m->from(config('mail.from.address'), config('mail.from.name'));
                $m->to(['contact@voyance-spirituelle-expert.com', 'emmanueladenidji@gmail.com'], 'Contact Form');
                $m->subject('Nouveau message de contact');
            });

            // Reset form fields
            $this->name = '';
            $this->email = '';
            $this->message = '';
            $this->email_confirm = '';

            session()->flash('success', 'Votre message a été envoyé avec succès !');
        } catch (\Exception $e) {
            dd($e);
            session()->flash('error', 'Une erreur est survenue lors de l\'envoi du message.');
        }
    }

    public function render()
    {
        // Store the timestamp when the form is loaded
        session(['form_time' => time()]);

        return view('livewire.pages.contact');
    }
}

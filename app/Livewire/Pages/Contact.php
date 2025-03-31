<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

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
        $this->validate();

        try {
            Mail::to('support@voyanceetbienveillance.com')->send(new ContactFormMail([
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message
            ]));

            $this->reset(['name', 'email', 'message']);
            session()->flash('success', 'Votre message a été envoyé avec succès !');
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de l\'envoi du message.');
        }
    }

    public function render()
    {
        return view('livewire.pages.contact');
    }
}

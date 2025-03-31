<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'role' => 'admin'], $this->remember)) {
            session()->regenerate();
            return redirect()->intended(route('admin.orders'));
        }

        session()->flash('error', 'Identifiants incorrects ou accès non autorisé.');
        return null;
    }

    public function render()
    {
        return view('livewire.auth.admin-login')
            ->layout('components.layouts.admin-app', ['title' => 'Connexion Administration']);
    }
}

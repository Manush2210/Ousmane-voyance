<?php

namespace App\Livewire\Pages\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profil extends Component
{
    public $name;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public $address;
    public $postal_code;
    public $city;
    public $country;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->postal_code = $user->postal_code;
        $this->city = $user->city;
        $this->country = $user->country;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        Auth::user()->update([
            'name' => $this->name,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'country' => $this->country,
        ]);

        $this->dispatch('showToast', [
            'message' => 'Profil mis à jour avec succès',
            'type' => 'success'
        ]);
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        $this->dispatch('showToast', [
            'message' => 'Mot de passe mis à jour avec succès',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.pages.account.profil');
    }
}

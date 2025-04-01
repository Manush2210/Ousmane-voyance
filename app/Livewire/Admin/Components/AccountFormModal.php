<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;
use App\Models\Account;

class AccountFormModal extends Component
{
    public $isOpen = false;
    public $owner;
    public $bank;
    public $iban;
    public $swift;
    public $address;

    public $appointment_pricing;
    public $country;
    public $is_active = true;
    public $editMode = false;
    public $accountId;

    protected $listeners = ['openModal', 'closeModal'];

    protected $rules = [
        'owner' => 'required|min:3',
        'bank' => 'nullable|string',
        'iban' => 'required|string',
        'swift' => 'required|string',
        'address' => 'nullable|string',
        'country' => 'nullable|string',
        'appointment_pricing' => 'required|numeric',
        'is_active' => 'boolean'
    ];

    public function openModal($accountId = null)
    {
        $this->resetForm();
        $this->isOpen = true;
        if ($accountId) {
            $this->editMode = true;
            $this->accountId = $accountId;
            $this->loadAccount($accountId);
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    public function loadAccount($id)
    {
        $account = Account::find($id);
        $this->owner = $account->owner;
        $this->bank = $account->bank;
        $this->iban = $account->iban;
        $this->swift = $account->swift;
        $this->address = $account->address;
        $this->country = $account->country;
        $this->is_active = $account->is_active;
        $this->appointment_pricing = $account->appointment_pricing;
    }

    public function save()
    {

        $this->validate();

        if ($this->editMode) {
            $account = Account::find($this->accountId);

            $account->update([
                'owner' => $this->owner,
                'bank' => $this->bank,
                'iban' => $this->iban,
                'swift' => $this->swift,
                'address' => $this->address,
                'country' => $this->country,
                'is_active' => $this->is_active,
                'appointment_pricing' => $this->appointment_pricing,
            ]);
            $message = 'Compte bancaire mis à jour avec succès.';
        } else {

            Account::create([
                'owner' => $this->owner,
                'bank' => $this->bank,
                'iban' => $this->iban,
                'swift' => $this->swift,
                'address' => $this->address,
                'country' => $this->country,
                'is_active' => $this->is_active,
                'appointment_pricing' => $this->appointment_pricing,
            ]);
            $message = 'Compte bancaire créé avec succès.';
        }

        $this->dispatch('account-saved', message: $message);
        $this->closeModal();
    }

    private function resetForm()
    {
        $this->reset(['owner', 'bank', 'iban', 'swift', 'address', 'country', 'editMode', 'accountId', 'appointment_pricing']);
        $this->is_active = true;
    }

    public function render()
    {
        return view('livewire.admin.components.account-form-modal');
    }
}

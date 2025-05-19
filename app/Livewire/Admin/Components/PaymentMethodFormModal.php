<?php

namespace App\Livewire\Admin\Components;

use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PaymentMethodFormModal extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $name;
    public $code;
    public $description;
    public $instructions;
    public $motifs;
    public $logo;
    public $currentLogo;
    public $is_active = true;
    public $editMode = false;
    public $paymentMethodId;
    public $receiver_firstname;
    public $receiver_lastname;
    public $receiver_country;
    public $address;

    protected $listeners = ['openModal', 'closeModal'];

    protected $rules = [
        'name' => 'required|min:3',
        'code' => 'required|min:3',
        'description' => 'nullable',
        'instructions' => 'nullable',
        'motifs' => 'nullable',
        'logo' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
        'receiver_firstname' => 'nullable|string|max:255',
        'receiver_lastname' => 'nullable|string|max:255',
        'receiver_country' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:500',
    ];

    public function openModal($paymentMethodId = null)
    {
        $this->resetForm();
        $this->isOpen = true;

        if ($paymentMethodId) {
            $this->editMode = true;
            $this->paymentMethodId = $paymentMethodId;
            $this->loadPaymentMethod($paymentMethodId);
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    public function loadPaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $this->name = $paymentMethod->name;
        $this->code = $paymentMethod->code;
        $this->description = $paymentMethod->description;
        $this->instructions = $paymentMethod->instructions;
        $this->motifs = $paymentMethod->motifs;
        $this->is_active = $paymentMethod->is_active;
        $this->currentLogo = $paymentMethod->logo;
        $this->receiver_firstname = $paymentMethod->receiver_firstname;
        $this->receiver_lastname = $paymentMethod->receiver_lastname;
        $this->receiver_country = $paymentMethod->receiver_country;
        $this->address = $paymentMethod->address;
    }

    public function updatedName()
    {
        if (!$this->editMode) {
            $this->code = Str::slug($this->name);
        }
    }

    public function save()
    {
        $this->validate();

        // Additional validation for code uniqueness when adding new or changing code
        if (!$this->editMode || ($this->editMode && $this->code != PaymentMethod::find($this->paymentMethodId)->code)) {
            $this->validate([
                'code' => 'unique:payment_methods,code',
            ]);
        }

        $logoPath = $this->currentLogo;
        if ($this->logo) {
            $logoPath = $this->logo->store('payment_methods', 'public');
        }

        if ($this->editMode) {
            $paymentMethod = PaymentMethod::find($this->paymentMethodId);
            $paymentMethod->update([
                'name' => $this->name,
                'code' => $this->code,
                'description' => $this->description,
                'instructions' => $this->instructions,
                'motifs' => $this->motifs,
                'is_active' => $this->is_active,
                'logo' => $logoPath,
                'receiver_firstname' => $this->receiver_firstname,
                'receiver_lastname' => $this->receiver_lastname,
                'receiver_country' => $this->receiver_country,
                'address' => $this->address,
            ]);
            $message = 'Moyen de paiement mis à jour avec succès.';
        } else {
            PaymentMethod::create([
                'name' => $this->name,
                'code' => $this->code,
                'description' => $this->description,
                'instructions' => $this->instructions,
                'motifs' => $this->motifs,
                'is_active' => $this->is_active,
                'logo' => $logoPath,
                'receiver_firstname' => $this->receiver_firstname,
                'receiver_lastname' => $this->receiver_lastname,
                'receiver_country' => $this->receiver_country,
                'address' => $this->address,
            ]);
            $message = 'Moyen de paiement créé avec succès.';
        }

        $this->dispatch('payment-method-saved', message: $message);
        $this->closeModal();
    }

    private function resetForm()
    {
        $this->reset(['name', 'code', 'description', 'instructions', 'motifs', 'logo', 'currentLogo', 'editMode', 'paymentMethodId', 'receiver_firstname', 'receiver_lastname', 'receiver_country', 'address']);
        $this->is_active = true;
    }

    public function render()
    {
        return view('livewire.admin.components.payment-method-form-modal');
    }
}

<?php

namespace App\Livewire\Admin\Pages;

use Livewire\Component;
use App\Models\Account;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin-app')]
class AddAccount extends Component
{
    protected $listeners = ['account-saved' => 'handleAccountSaved'];

    public function handleAccountSaved($message)
    {
        session()->flash('message', $message);
    }

    public function render()
    {
        $account = Account::first();

        return view('livewire.admin.pages.add-account', [
            'account' => $account
        ]);
    }
}

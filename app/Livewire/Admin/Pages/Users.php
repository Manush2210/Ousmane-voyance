<?php

namespace App\Livewire\Admin\Pages;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $role = '';
    public $orderBy = 'created_at';
    public $orderDirection = 'desc';

    public function updateRole($userId, $role)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['role' => $role]);
            $this->dispatch('showToast', [
                'message' => 'Rôle mis à jour avec succès',
                'type' => 'success'
            ]);
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('email', 'like', '%' . $this->search . '%')
                      ->orWhere('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->role, function($query) {
                $query->where('role', $this->role);
            })
            ->orderBy($this->orderBy, $this->orderDirection)
            ->paginate(10);

        return view('livewire.admin.pages.users', [
            'users' => $users
        ])->layout('components.layouts.admin-app');
    }
}

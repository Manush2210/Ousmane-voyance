<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Order;
use Livewire\Component;

class OrderDetail extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function updateStatus($status)
    {
        $this->order->update(['status' => $status]);
        $this->dispatch('showToast', [
            'message' => 'Statut de la commande mis à jour',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.pages.order-detail', [
            'order' => $this->order->load(['items', 'user'])
        ])->layout('components.layouts.admin-app');
    }
}

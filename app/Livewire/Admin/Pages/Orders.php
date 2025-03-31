<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $orderBy = 'created_at';
    public $orderDirection = 'desc';

    public function setOrderStatus($orderId, $status)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => $status]);
            $this->dispatch('showToast', [
                'message' => 'Statut de la commande mis à jour',
                'type' => 'success'
            ]);
        }
    }

    public function render()
    {
        $orders = Order::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('order_number', 'like', '%' . $this->search . '%')
                      ->orWhere('shipping_email', 'like', '%' . $this->search . '%')
                      ->orWhere('shipping_first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('shipping_last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->orderBy, $this->orderDirection)
            ->paginate(10);

        return view('livewire.admin.pages.orders', [
            'orders' => $orders
        ])->layout('components.layouts.admin-app');
    }
}

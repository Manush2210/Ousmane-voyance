<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;

class Shop extends Component
{
    public $products = [];
    public function mount()
    {
        $this->products = Product::where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->get();
    }
    public function render()
    {
        return view('livewire.pages.shop');
    }
}

<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Product;
use App\Models\ConsultationType;

class Home extends Component
{

    public $products;
    public $consultationTypes;

    public function mount()
    {
        $this->products = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

    // Charger les types de consultation actifs pour les afficher sur la page d'accueil
    $this->consultationTypes = ConsultationType::active()->get();
    }
    public function render()
    {
        return view('livewire.pages.home');
    }
}

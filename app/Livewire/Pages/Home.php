<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Product;
use App\Models\ConsultationType;
use App\Models\Testimonial;

class Home extends Component
{

    public $products;
    public $consultationTypes;
    public $testimonials;

    public function mount()
    {
        $this->products = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Charger les types de consultation actifs pour les afficher sur la page d'accueil
        $this->consultationTypes = ConsultationType::active()->get();

        // Charger les témoignages actifs pour les afficher sur la page d'accueil
        $this->testimonials = Testimonial::active()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}

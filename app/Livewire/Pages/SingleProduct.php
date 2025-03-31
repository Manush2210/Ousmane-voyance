<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use Livewire\Component;

class SingleProduct extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->product = \App\Models\Product::where('slug', $slug)->firstOrFail();

        // Si le produit n'est pas actif, redirigez vers la page d'accueil
        if (!$this->product->is_active) {
            return redirect()->route('home');
        }

    }

    public function increment()
    {
        $this->quantity++;
    }
    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($productId, $quantity = 1)
    {
        if ($this->quantity > 1) {
            $quantity = $this->quantity;
        }
        try {
            Cart::addProduct($productId, $quantity);

            // Notifier et mettre à jour l'interface
            $this->dispatch('cartUpdated');
            $this->dispatch('showToast', [
                'message' => 'Produit ajouté au panier',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('showToast', [
                'message' => 'Erreur: ' . $th->getMessage(),
                'type' => 'error'
            ]);
        }

        session()->flash('message', 'Produit ajouté au panier.');
    }
    public function render()
    {
        return view('livewire.pages.single-product');
    }
}

<?php

namespace App\Livewire\Components\Product;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ProductCard extends Component
{
    public $product;
    public $images;
    public $title;
    public $price;

    public $slug;

    public function mount($images, $title, $price, $slug)
    {
        $this->slug = $slug;
        if($this->slug !== null) {
            $this->product = Product::where('slug', $slug)->first();
        if (!$this->product) {
            abort(404);
        }
        //dd($this->product);
        //dd($images, $title, $price);

        $this->images = $images;
        $this->title = $title;
        $this->price = $price;
        }

    }

    public function addToCart($productId, $quantity = 1)
    {
        try {
            Cart::addProduct($productId, $quantity);

            // Notifier et mettre à jour l'interface
            $this->dispatch('cartUpdated');
            $this->dispatch('showToast', [
                'message' => 'Produit ajouté au panier',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            // Ajout d'un log pour diagnostiquer les erreurs
            Log::error('Erreur lors de l\'ajout au panier : ' . $th->getMessage());

            $this->dispatch('showToast', [
                'message' => 'Erreur: ' . $th->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function removeFromCart($productId)
    {
        // Logic to remove the product from the cart
        // This is just a placeholder for the actual implementation
        session()->flash('message', 'Produit retiré du panier !');
    }

    public function render()
    {
        return view('livewire.components.product.product-card');
    }
}

<?php

namespace App\Livewire\Components\Product;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class ProductCard extends Component
{
    public Product  $product;
    public $images;
    public $title;
    public $price;

    public $slug;

    public function mount($images, $title, $price, $slug)
    {
        $this->slug = $slug;
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

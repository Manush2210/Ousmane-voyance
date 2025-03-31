<?php

namespace App\Livewire\Components\Product;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class ProductListView extends Component
{
    public $images;
    public $title;
    public $price;
    public $product;
    public $slug;
    public $description;

    public function mount($images, $title, $price,$slug, $description)
    {
        $this->slug = $slug;
        if ($this->slug !== null) {
            $this->product = Product::where('slug', $slug)->first();
            if (!$this->product) {
                abort(404);
            }
            $this->images = $images;
            $this->title = $title;
            $this->price = $price;
            $this->description = $description;
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
            $this->dispatch('showToast', [
                'message' => 'Erreur: ' . $th->getMessage(),
                'type' => 'error'
            ]);
        }

        session()->flash('message', 'Produit ajouté au panier.');
    }

    public function render()
    {
        return view('livewire.components.product.product-list-view');
    }
}

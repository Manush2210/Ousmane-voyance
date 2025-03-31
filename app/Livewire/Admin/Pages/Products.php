<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin-app')]
class Products extends Component
{
    use WithPagination;

    public $search = '';
    public $showAll = false;

    public function render()
    {
        $query = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc');

        $products = $query->paginate(10);
        $mobileProducts = $this->showAll ? $products : $query->take(3)->get();

        return view('livewire.admin.pages.products', [
            'products' => $products,
            'mobileProducts' => $mobileProducts
        ]);
    }

    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Produit supprimé avec succès.');
    }
}

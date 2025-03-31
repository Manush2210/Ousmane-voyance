<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $results = [];

    public function mount($search = '')
    {
        $this->search = $search;
        // Exécuter la recherche immédiatement au chargement
        $this->performSearch();
    }

    public function updatedSearch()
    {
        $this->performSearch();
    }

    private function performSearch()
    {
        $this->results = [];

        // Ne rien faire si la recherche est vide ou trop courte
        if (empty($this->search) || strlen($this->search) < 2) {
            return;
        }

        // Effectuer la recherche avec une requête améliorée
        $searchTerm = '%' . trim($this->search) . '%';

        $this->results = Product::where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', $searchTerm);})
                  ->orWhere('description', 'like', $searchTerm)
          ->where('is_active', true) // Assurez-vous que le produit est actif
        ->get();

    }


    public function render()
    {
        return view('livewire.pages.search');
    }
}

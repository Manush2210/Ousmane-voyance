<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{

    public $search='';
    public $isMenuOpen = false;
    public $cartItemCount = 0;
    public $cartItems = [];
    public $popularSearches = [
        'cartes', 'tarot', 'pendule', 'oracle'
    ];
    public $topBarItems = [
        'Cartes et Jeux Divinatoires',
        'Service client personnalisé',
        'Suivi continu'
    ];

    public $currentTopBarItemIndex = 0;

    public function mount(): void
    {
        $this->startTopBarCarousel();
        $this->updateCartData();
    }

    #[On('cartUpdated')]
    public function updateCartData()
    {
        if (auth()->check()) {
            // Utilisateur connecté : obtenir depuis la BD
            $user = auth()->user();
            if ($user->cart) {
                $this->cartItems = $user->cart->items()->with('product')->get()->toArray();
                $this->cartItemCount = $user->cart->items()->sum('quantity');
            } else {
                $this->cartItems = [];
                $this->cartItemCount = 0;
            }
        } else {
            // Visiteur : obtenir depuis la session et normaliser le format
            $sessionCart = session()->get('cart', ['items' => []]);

            // Transformer le format de session en format similaire à celui d'Eloquent
            $normalizedItems = [];
            foreach ($sessionCart['items'] as $id => $item) {
                $normalizedItems[] = $item; // Déjà normalisé dans addProduct
            }

            $this->cartItems = $normalizedItems;
            $this->cartItemCount = array_sum(array_column($normalizedItems, 'quantity'));
        }
    }

    public function removeCart()
    {
        if (auth()->check()) {
            // Utilisateur connecté : vider le panier lié au modèle
            $user = auth()->user();
            if ($user->cart) {
                $user->cart->items()->delete();
                $user->cart->delete();
                $this->dispatch('showToast', [
                    'message' => 'Panier vidé',
                    'type' => 'success'
                ]);
            } else {
                $this->dispatch('showToast', [
                    'message' => 'Le panier est déjà vide',
                    'type' => 'error'
                ]);
            }
        } else {
            // Visiteur : vider le panier en session
            if (session()->has('cart')) {
                session()->forget('cart');
                $this->dispatch('showToast', [
                    'message' => 'Panier vidé',
                    'type' => 'success'
                ]);
            } else {
                $this->dispatch('showToast', [
                    'message' => 'Le panier est déjà vide',
                    'type' => 'error'
                ]);
            }
        }

        $this->updateCartData();
    }

    public function startTopBarCarousel()
    {
        try {
            $itemsCount = count($this->topBarItems);
            if ($itemsCount === 0) {
                $this->currentTopBarItemIndex = 0;
                return;
            }
            $this->currentTopBarItemIndex =
                ($this->currentTopBarItemIndex + 1) % $itemsCount;
        } catch (\Exception $e) {
            $this->currentTopBarItemIndex = 0;
        }
    }

    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.layout.navbar');
    }
}

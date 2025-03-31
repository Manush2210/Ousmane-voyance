<?php

namespace App\Livewire\Pages;

use App\Models\User;
use App\Models\Account;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\WithFileUploads;
use App\Models\Order as OrderModel;
use App\Mail\OrderAdminNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCustomerConfirmation;

class Order extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $accountOption = 'login'; // 'login' ou 'register'

    // Détails utilisateur
    public $type_client = 'private';
    public $first_name;
    public $last_name;
    public $phone;
    public $address;
    public $postal_code;
    public $city;
    public $country = 'France';
    public $email;
    public $password;
    public $password_confirmation;
    public $name; // Nom d'utilisateur pour l'inscription

    // Options de livraison
    public $use_different_shipping = false;
    public $shipping_first_name;
    public $shipping_last_name;
    public $shipping_address;
    public $shipping_postal_code;
    public $shipping_city;
    public $shipping_country = 'France';

    // Paiement
    public $payment_method = 'card';
    public $notes;
    public $payment_proof; // Pour le justificatif
    public $has_proof = false; // Indicateur si preuve téléchargée
    public $account; // Pour les coordonnées bancaires

    // Résumé commande
    public $cartItems = [];
    public $subTotal = 0;
    public $shippingCost = 0;
    public $total = 0;

    public function mount()
    {
        // Récupérer les coordonnées bancaires
        $this->account = Account::getLastActive();
        $this->payment_method = 'transfer'; // Forcer le virement comme méthode par défaut

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
        // Vérifier si le panier est vide
        $cart = $this->cartItems;
        if (empty($cart)) {
            $this->dispatch('showToast', [
                'message' => 'Votre panier est vide',
                'type' => 'error'
            ]);
            return redirect()->route('cart');
        }

        // Charger les articles du panier et calculer les totaux
        $this->updateOrderSummary();

        if (Auth::check()) {
            $user = Auth::user();
            $this->accountOption = 'login';
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->phone = $user->phone;
            $this->address = $user->address;
            $this->postal_code = $user->postal_code;
            $this->city = $user->city;
            $this->country = $user->country;
            $this->email = $user->email;
            $this->type_client = $user->client_type;
        } else {
            $this->accountOption = 'register';
        }
    }

    private function updateOrderSummary()
    {
        // Calculer les totaux en utilisant les articles déjà chargés dans mount()
        $this->subTotal = 0;

        // La structure diffère selon que l'utilisateur est connecté ou non
        if (auth()->check()) {
            // Pour un utilisateur connecté, la structure est celle d'Eloquent
            foreach ($this->cartItems as $item) {
                $this->subTotal += $item['product']['price'] * $item['quantity'];
            }
        } else {
            // Pour un visiteur, la structure est celle de la session
            foreach ($this->cartItems as $item) {
                $this->subTotal += $item['product']['price'] * $item['quantity'];
            }
        }

        // Définir les frais de livraison (à personnaliser selon vos règles)
        $this->shippingCost = $this->subTotal > 100 ? 0 : 9.99;
        $this->total = $this->subTotal + $this->shippingCost;
    }

    public function goToNextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
                'postal_code' => 'required',
                'city' => 'required',
            ]);

            if ($this->accountOption === 'register' && !Auth::check()) {
                $this->validate([
                    'password' => 'required|min:8|confirmed',
                    'name' => 'required|min:3|unique:users',
                ]);
            }

            if ($this->use_different_shipping) {
                $this->validate([
                    'shipping_first_name' => 'required',
                    'shipping_last_name' => 'required',
                    'shipping_address' => 'required',
                    'shipping_postal_code' => 'required',
                    'shipping_city' => 'required',
                ]);
            }
        } else if ($this->step === 2) {
            $this->validate([
                'payment_method' => 'required',
            ]);
        }

        $this->step++;

        // Si on arrive à l'étape finale, rafraîchir les données du résumé
        if ($this->step === 3) {
            $this->updateOrderSummary();
        }
    }

    public function goToPreviousStep()
    {
        $this->step--;
    }

    public function loginUser()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->phone = $user->phone;
            $this->address = $user->address;
            $this->postal_code = $user->postal_code;
            $this->city = $user->city;

            $this->dispatch('showToast', [
                'message' => 'Connexion réussie',
                'type' => 'success'
            ]);

            $this->goToNextStep();
        } else {
            $this->addError('email', 'Identifiants incorrects');
        }
    }

    public function updatedPaymentProof()
    {
        $this->validate([
            'payment_proof' => 'required|file|max:10240|mimes:jpeg,png,jpg,pdf',
        ]);

        $this->has_proof = true;
    }

    public function createOrder()
    {
        // Wrap the entire operation in a database transaction
        return \DB::transaction(function () {
            // Si l'utilisateur a choisi de s'inscrire
            if ($this->accountOption === 'register' && !Auth::check()) {
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'postal_code' => $this->postal_code,
                    'city' => $this->city,
                    'country' => $this->country,
                    'client_type' => $this->type_client,
                    'role' => 'user',
                ]);

                Auth::login($user);
            }

            // Créer la commande
            $order = OrderModel::create([
                'user_id' => Auth::id(),
                'order_number' => OrderModel::generateOrderNumber(),
                'status' => 'pending',
                'subtotal' => $this->subTotal,
                'shipping' => $this->shippingCost,
                'total' => $this->total,
                'payment_method' => $this->payment_method,
                'shipping_first_name' => $this->use_different_shipping ? $this->shipping_first_name : $this->first_name,
                'shipping_last_name' => $this->use_different_shipping ? $this->shipping_last_name : $this->last_name,
                'shipping_email' => $this->email,
                'shipping_phone' => $this->phone,
                'shipping_address' => $this->use_different_shipping ? $this->shipping_address : $this->address,
                'shipping_postal_code' => $this->use_different_shipping ? $this->shipping_postal_code : $this->postal_code,
                'shipping_city' => $this->use_different_shipping ? $this->shipping_city : $this->city,
                'shipping_country' => $this->use_different_shipping ? $this->shipping_country : $this->country,
                'billing_same_as_shipping' => !$this->use_different_shipping,
                'billing_first_name' => $this->first_name,
                'billing_last_name' => $this->last_name,
                'billing_email' => $this->email,
                'billing_phone' => $this->phone,
                'billing_address' => $this->address,
                'billing_postal_code' => $this->postal_code,
                'billing_city' => $this->city,
                'billing_country' => $this->country,
                'notes' => $this->notes,
            ]);

            // Ajouter les articles à la commande
            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']['id'],
                    'product_name' => $item['product']['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product']['price'],
                ]);
            }

            // Ajouter cette partie pour enregistrer la preuve de paiement
            if ($this->has_proof) {
                $proofPath = $this->payment_proof->store('payment_proofs', 'public');
                $order->update(['payment_proof' => $proofPath]);
            }
            // Envoyer les emails de notification
            try {
                // Récupérer l'order avec ses items pour les emails
                $orderWithItems = OrderModel::with('items')->find($order->id);

                // Email à l'administrateur
                Mail::to('support@voyanceetbienveillance.com')
                    ->send(new OrderAdminNotification($orderWithItems));

                // Email au client
                Mail::to($orderWithItems->billing_email)
                    ->send(new OrderCustomerConfirmation($orderWithItems));
            } catch (\Exception $e) {
                // Log l'erreur mais continue le process
                logger()->error('Erreur lors de l\'envoi des emails de commande: ' . $e->getMessage());
            }

            // Vider le panier
            if (Auth::check() && Auth::user()->cart) {
                Auth::user()->cart->items()->delete();
            } else {
                session()->forget('cart');
            }
            $this->dispatch('cartUpdated');

            // Afficher la confirmation
            $this->dispatch('showToast', [
                'message' => 'Commande créée avec succès',
                'type' => 'success'
            ]);

            // Rediriger vers la confirmation with success message new-order
            return redirect()->route('order-history')->with('new-order', 'Votre commande a été créée avec succès. Un mail de confirmation vous a été envoyé.');
        });
    }


    public function render()
    {
        return view('livewire.pages.order');
    }
}

<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Commander</h1>

    <!-- Étapes -->
    <div class="flex items-center mb-6">
        <div class="w-1/3 text-center">
            <div
                class="font-semibold p-2 border-b-4 {{ $step === 1 ? 'border-purple-600 text-purple-600' : 'border-gray-200 text-gray-500' }}">
                <i class="fas fa-id-card mr-1"></i>Détails
            </div>
        </div>
        <div class="w-1/3 text-center">
            <div
                class="font-semibold p-2 border-b-4 {{ $step === 2 ? 'border-purple-600 text-purple-600' : 'border-gray-200 text-gray-500' }}">
                <i class="fas fa-credit-card mr-1"></i>Mode de paiement
            </div>
        </div>
        <div class="w-1/3 text-center">
            <div
                class="font-semibold p-2 border-b-4 {{ $step === 3 ? 'border-purple-600 text-purple-600' : 'border-gray-200 text-gray-500' }}">
                <i class="fas fa-check mr-1"></i>Confirmation
            </div>
        </div>
    </div>

    <!-- ÉTAPE 1: Informations client -->
    @if ($step === 1)
        @if (!Auth::check())
            <!-- Choix connexion ou création compte -->
            <div class="mb-6 space-y-4">
                <label
                    class="flex items-center space-x-2 border p-4 rounded-md {{ $accountOption === 'register' ? 'border-purple-500' : 'border-gray-200' }}">
                    <input type="radio" wire:model.live="accountOption" value="register" />
                    <span>Créer un compte</span>
                </label>

                <label
                    class="flex items-center space-x-2 border p-4 rounded-md {{ $accountOption === 'login' ? 'border-purple-500' : 'border-gray-200' }}">
                    <input type="radio" wire:model.live="accountOption" value="login" />
                    <span>Connexion</span>
                </label>
            </div>

            @if ($accountOption === 'login')
                <!-- Formulaire de connexion -->
                <form wire:submit="loginUser" class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Adresse e-mail</label>
                        <input type="email" wire:model="email" class="w-full border rounded px-3 py-2 bg-gray-100">
                        @error('email')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Mot de passe</label>
                        <input type="password" wire:model="password"
                            class="w-full border rounded px-3 py-2 bg-gray-100">
                        @error('password')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                        {{-- <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:underline mt-1 inline-block">Mot de passe oublié ?</a> --}}
                    </div>
                    <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-300">Se
                        connecter</button>
                </form>
            @else
                <!-- Formulaire création de compte -->
                <div class="space-y-4">
                    <div class="flex space-x-6">
                        <label class="flex items-center space-x-2">
                            <input type="radio" wire:model="type_client" value="private" />
                            <span>Particulier</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" wire:model="type_client" value="pro" />
                            <span>Professionnel</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-gray-700">Nom d'utilisateur</label>
                        <input type="text" wire:model="name" class="w-full border px-3 py-2 bg-gray-100 rounded">
                        @error('name')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Prénom</label>
                            <input type="text" wire:model="first_name"
                                class="border w-full px-3 py-2 bg-gray-100 rounded">
                            @error('first_name')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Nom</label>
                            <input type="text" wire:model="last_name"
                                class="border w-full px-3 py-2 bg-gray-100 rounded">
                            @error('last_name')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Téléphone</label>
                        <input type="text" wire:model="phone" class="w-full border px-3 py-2 bg-gray-100 rounded">
                        @error('phone')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700">Adresse</label>
                        <input type="text" wire:model="address" class="w-full border px-3 py-2 bg-gray-100 rounded">
                        @error('address')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Code postal</label>
                            <input type="text" wire:model="postal_code" class="border px-3 py-2 bg-gray-100 rounded">
                            @error('postal_code')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Ville</label>
                            <input type="text" wire:model="city" class="border px-3 py-2 bg-gray-100 rounded">
                            @error('city')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Pays</label>
                        <select wire:model="country" class="w-full border px-3 py-2 bg-gray-100 rounded">
                            <option value="France">France</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Canada">Canada</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">Adresse e-mail</label>
                        <input type="email" wire:model="email" class="w-full border px-3 py-2 bg-gray-100 rounded">
                        @error('email')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700">Mot de passe</label>
                        <input type="password" wire:model="password"
                            class="w-full border px-3 py-2 bg-gray-100 rounded">
                        @error('password')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" wire:model="password_confirmation"
                            class="w-full border px-3 py-2 bg-gray-100 rounded">
                    </div>
                </div>
            @endif
        @else
            <!-- Utilisateur déjà connecté: Vérification des informations -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold mb-2">Informations personnelles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700">Prénom</label>
                        <input type="text" wire:model="first_name"
                            class="border w-full px-3 py-2 bg-gray-100 rounded">
                        @error('first_name')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Nom</label>
                        <input type="text" wire:model="last_name"
                            class="border w-full px-3 py-2 bg-gray-100 rounded">
                        @error('last_name')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block text-gray-700">Téléphone</label>
                    <input type="text" wire:model="phone" class="w-full border px-3 py-2 bg-gray-100 rounded">
                    @error('phone')
                        <span class="text-purple-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-3">
                    <label class="block text-gray-700">Adresse</label>
                    <input type="text" wire:model="address" class="w-full border px-3 py-2 bg-gray-100 rounded">
                    @error('address')
                        <span class="text-purple-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mt-3">
                    <div>
                        <label class="block text-gray-700">Code postal</label>
                        <input type="text" wire:model="postal_code" class="border px-3 py-2 bg-gray-100 rounded">
                        @error('postal_code')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Ville</label>
                        <input type="text" wire:model="city" class="border px-3 py-2 bg-gray-100 rounded">
                        @error('city')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <!-- Adresse de livraison différente -->
        <div class="mt-6">
            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model.live="use_different_shipping" class="rounded">
                <span>Utiliser une adresse de livraison différente</span>
            </label>

            @if ($use_different_shipping)
                <div class="mt-4 p-4 border rounded-lg space-y-4">
                    <h3 class="font-semibold">Adresse de livraison</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Prénom</label>
                            <input type="text" wire:model="shipping_first_name"
                                class="border w-full px-3 py-2 bg-gray-100 rounded">
                            @error('shipping_first_name')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Nom</label>
                            <input type="text" wire:model="shipping_last_name"
                                class="border w-full px-3 py-2 bg-gray-100 rounded">
                            @error('shipping_last_name')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Adresse</label>
                        <input type="text" wire:model="shipping_address"
                            class="w-full border px-3 py-2 bg-gray-100 rounded">
                        @error('shipping_address')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Code postal</label>
                            <input type="text" wire:model="shipping_postal_code"
                                class="border px-3 py-2 bg-gray-100 rounded">
                            @error('shipping_postal_code')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Ville</label>
                            <input type="text" wire:model="shipping_city"
                                class="border px-3 py-2 bg-gray-100 rounded">
                            @error('shipping_city')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Pays</label>
                        <select wire:model="shipping_country" class="w-full border px-3 py-2 bg-gray-100 rounded">
                            <option value="France">France</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Canada">Canada</option>
                        </select>
                    </div>
                </div>
            @endif
        </div>

        <!-- Navigation -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('cart') }}" class="text-purple-600 hover:underline">« Panier</a>
            <button wire:click="goToNextStep"
                class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-300">Suivant »</button>
        </div>

        <!-- ÉTAPE 2: Mode de paiement -->
    @elseif ($step === 2)
        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Choisissez votre mode de paiement</h2>

            <div class="space-y-4">
                @if (count($paymentMethods) > 0)
                    @foreach ($paymentMethods as $method)
                        <label
                            class="flex items-center p-4 border rounded-lg {{ $payment_method == $method->code ? 'border-purple-500 bg-purple-50' : 'border-gray-200' }}">
                            <input type="radio" wire:model.live="payment_method" value="{{ $method->code }}"
                                class="mr-3">
                            <div>
                                @if ($method->logo)
                                    <img src="{{ Storage::url($method->logo) }}" alt="{{ $method->name }}"
                                        class="h-6 mb-1">
                                @endif
                                <span class="font-medium">{{ $method->name }}</span>
                                <p class="text-sm text-gray-500">{{ $method->description }}</p>
                            </div>
                        </label>
                    @endforeach
                @else
                    <div class="p-4 border rounded-lg border-yellow-300 bg-yellow-50">
                        <p class="text-yellow-700">Aucune méthode de paiement n'est disponible pour le moment. Veuillez
                            nous contacter pour plus d'informations.</p>
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <label class="block text-gray-700">Notes pour la commande (optionnel)</label>
                <textarea wire:model="notes" rows="3" class="w-full border px-3 py-2 bg-gray-100 rounded"></textarea>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-6">
                <button wire:click="goToPreviousStep" class="text-purple-600 hover:underline">« Retour</button>
                <button wire:click="goToNextStep"
                    class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-300"
                    {{ count($paymentMethods) == 0 ? 'disabled' : '' }}>
                    Vérifier la commande »
                </button>
            </div>
        </div>

        <!-- ÉTAPE 3: Confirmation -->
    @elseif ($step === 3)
        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Vérification de votre commande</h2>

            <!-- Récapitulatif des articles -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold border-b pb-2 mb-3">Articles commandés</h3>

                <div class="space-y-3">
                    @if (auth()->check())
                        @foreach ($cartItems as $item)
                            <div class="flex items-center space-x-3 py-2 border-b">
                                <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                    alt="{{ $item['product']['name'] }}" class="w-12 h-12 object-cover rounded">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium">{{ $item['product']['name'] }}</h4>
                                    <p class="text-xs text-gray-500">Quantité: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="text-purple-700 font-medium">
                                    {{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }}€
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($cartItems as $item)
                            <div class="flex items-center space-x-3 py-2 border-b">
                                <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                    alt="{{ $item['product']['name'] }}" class="w-12 h-12 object-cover rounded">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium">{{ $item['product']['name'] }}</h4>
                                    <p class="text-xs text-gray-500">Quantité: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="text-purple-700 font-medium">
                                    {{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }}€
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mt-4 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span>Sous-total:</span>
                        <span>{{ number_format($subTotal, 2, ',', ' ') }}€</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Frais de livraison:</span>
                        <span>{{ number_format($shippingCost, 2, ',', ' ') }}€</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2 border-t">
                        <span>Total:</span>
                        <span>{{ number_format($total, 2, ',', ' ') }}€</span>
                    </div>
                </div>
            </div>

            <!-- Récapitulatif client -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold border-b pb-2 mb-3">Informations de facturation</h3>
                <p>{{ $first_name }} {{ $last_name }}</p>
                <p>{{ $address }}</p>
                <p>{{ $postal_code }} {{ $city }}</p>
                <p>{{ $country }}</p>
                <p>{{ $email }}</p>
                <p>{{ $phone }}</p>
            </div>

            @if ($use_different_shipping)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold border-b pb-2 mb-3">Informations de livraison</h3>
                    <p>{{ $shipping_first_name }} {{ $shipping_last_name }}</p>
                    <p>{{ $shipping_address }}</p>
                    <p>{{ $shipping_postal_code }} {{ $shipping_city }}</p>
                    <p>{{ $shipping_country }}</p>
                </div>
            @endif

            <!-- Méthode de paiement -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold border-b pb-2 mb-3">Méthode de paiement</h3>
                @php
                    $selectedMethod = $paymentMethods->firstWhere('code', $payment_method);
                @endphp

                @if ($selectedMethod)
                    <p class="mb-2">{{ $selectedMethod->name }}</p>
                    @if ($selectedMethod->motifs)
                        <div class="mb-2">
                            <span class="font-medium">Motifs :</span>
                            <span class="text-gray-700">{{ $selectedMethod->motifs }}</span>
                        </div>
                    @endif
                    @if ($selectedMethod->address)
                        <div class="mb-2">
                            <span class="font-medium">Adresse :</span>
                            <span class="text-gray-700">{{ $selectedMethod->address }}</span>
                        </div>
                    @endif

                    @if ($selectedMethod->code == 'transfer' && $account)
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg mb-4">
                            <h4 class="font-semibold text-yellow-800 mb-2">Coordonnées bancaires</h4>
                            <p class="mb-1"><span class="font-medium">Bénéficiaire:</span> {{ $account->owner }}
                            </p>
                            <p class="mb-1"><span class="font-medium">IBAN:</span> {{ $account->iban }}</p>
                            <p class="mb-1"><span class="font-medium">BIC/SWIFT:</span> {{ $account->swift }}</p>
                            <p class="mb-1"><span class="font-medium">Banque:</span> {{ $account->bank }}</p>
                            <p class="mb-1"><span class="font-medium">Adresse:</span> {{ $account->address }}</p>
                            @if ($account->country)
                                <p class="mb-1"><span class="font-medium">Pays:</span> {{ $account->country }}</p>
                            @endif
                        </div>
                    @endif

                    @if ($selectedMethod->receiver_firstname || $selectedMethod->receiver_lastname || $selectedMethod->receiver_country)
                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg mb-4">
                            <h4 class="font-semibold text-blue-800 mb-2">Informations du destinataire</h4>
                            <div class="space-y-1">
                                @if ($selectedMethod->receiver_firstname || $selectedMethod->receiver_lastname)
                                    <p class="mb-1">
                                        @if ($selectedMethod->receiver_firstname)
                                            <span class="font-medium">Prénom:</span>
                                            {{ $selectedMethod->receiver_firstname }}
                                        @endif
                                    </p>
                                    <p class="mb-1">
                                        @if ($selectedMethod->receiver_lastname)
                                            <span class="font-medium">Nom:</span>
                                            {{ $selectedMethod->receiver_lastname }}
                                        @endif
                                    </p>
                                @endif

                                @if ($selectedMethod->receiver_country)
                                    <p class="mb-1">
                                        <span class="font-medium">Pays:</span>
                                        {{ $selectedMethod->receiver_country }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                    <p class="text-purple-500">Méthode de paiement non disponible. Veuillez nous contacter.</p>
                @endif

                <!-- Upload de justificatif -->
                <div class="mt-4">
                    <h4 class="font-semibold mb-2">Justificatif de paiement</h4>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        @if ($has_proof)
                            <p class="text-purple-600 mb-2"><i class="fas fa-check-circle mr-2"></i>Justificatif
                                téléchargé</p>
                            <button wire:click="$set('has_proof', false)"
                                class="text-sm text-purple-600 hover:underline">
                                Changer de fichier
                            </button>
                        @else
                            <label for="payment_proof" class="block cursor-pointer">
                                <i class="fas fa-upload text-gray-400 text-xl mb-2"></i>
                                <p class="text-sm text-gray-500 mb-1">Cliquez pour télécharger un justificatif de
                                    paiement</p>
                                <p class="text-xs text-gray-400">(Formats acceptés: JPG, PNG, PDF - Max 10Mo)</p>
                                <input type="file" id="payment_proof" wire:model="payment_proof" class="hidden"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </label>
                            @error('payment_proof')
                                <p class="text-purple-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-6">
                <button wire:click="goToPreviousStep" class="text-purple-600 hover:underline">« Retour</button>
                <button wire:click="createOrder"
                    class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-300 disabled:bg-gray-400 disabled:cursor-not-allowed"
                    {{ !$has_proof ? 'disabled' : '' }} wire:loading.attr="disabled" wire:target="createOrder">
                    <span wire:loading.remove wire:target="createOrder">
                        {{ !$has_proof ? 'Télécharger un justificatif pour continuer' : 'Confirmer la commande' }}
                    </span>
                    <span wire:loading wire:target="createOrder" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Traitement en cours...
                    </span>
                </button>
            </div>
        </div>
    @endif
</div>

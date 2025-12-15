<div class="mx-auto p-6 max-w-4xl">
    <h1 class="mb-6 font-bold text-2xl">Commander</h1>

    <!-- Étapes -->
    <div class="flex items-center mb-6">
        <div class="w-1/3 text-center">
            <div
                class="font-semibold p-2 border-b-4 {{ $step === 1 ? 'border-emerald-600 text-emerald-600' : 'border-gray-200 text-gray-500' }}">
                <i class="mr-1 fas fa-id-card"></i>Détails
            </div>
        </div>
        <div class="w-1/3 text-center">
            <div
                class="font-semibold p-2 border-b-4 {{ $step === 2 ? 'border-emerald-600 text-emerald-600' : 'border-gray-200 text-gray-500' }}">
                <i class="mr-1 fas fa-credit-card"></i>Mode de paiement
            </div>
        </div>
        <div class="w-1/3 text-center">
            <div
                class="font-semibold p-2 border-b-4 {{ $step === 3 ? 'border-emerald-600 text-emerald-600' : 'border-gray-200 text-gray-500' }}">
                <i class="mr-1 fas fa-check"></i>Confirmation
            </div>
        </div>
    </div>

    <!-- ÉTAPE 1: Informations client -->
    @if ($step === 1)
        @if (!Auth::check())
            <!-- Choix connexion ou création compte -->
            <div class="space-y-4 mb-6">
                <label
                    class="flex items-center space-x-2 border p-4 rounded-md {{ $accountOption === 'register' ? 'border-emerald-500' : 'border-gray-200' }}">
                    <input type="radio" wire:model.live="accountOption" value="register" />
                    <span>Créer un compte</span>
                </label>

                <label
                    class="flex items-center space-x-2 border p-4 rounded-md {{ $accountOption === 'login' ? 'border-emerald-500' : 'border-gray-200' }}">
                    <input type="radio" wire:model.live="accountOption" value="login" />
                    <span>Connexion</span>
                </label>
            </div>

            @if ($accountOption === 'login')
                <!-- Formulaire de connexion -->
                <form wire:submit="loginUser" class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Adresse e-mail</label>
                        <input type="email" wire:model="email" class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('email')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Mot de passe</label>
                        <input type="password" wire:model="password"
                            class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('password')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                        {{-- <a href="{{ route('password.request') }}" class="inline-block mt-1 text-emerald-600 text-sm hover:underline">Mot de passe oublié ?</a> --}}
                    </div>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-300 px-6 py-2 rounded text-white">Se
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
                        <input type="text" wire:model="name" class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('name')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <label class="block text-gray-700">Prénom</label>
                            <input type="text" wire:model="first_name"
                                class="bg-gray-100 px-3 py-2 border rounded w-full">
                            @error('first_name')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Nom</label>
                            <input type="text" wire:model="last_name"
                                class="bg-gray-100 px-3 py-2 border rounded w-full">
                            @error('last_name')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Téléphone</label>
                        <input type="text" wire:model="phone" class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('phone')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700">Adresse</label>
                        <input type="text" wire:model="address" class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('address')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block text-gray-700">Code postal</label>
                            <input type="text" wire:model="postal_code" class="bg-gray-100 px-3 py-2 border rounded">
                            @error('postal_code')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Ville</label>
                            <input type="text" wire:model="city" class="bg-gray-100 px-3 py-2 border rounded">
                            @error('city')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Pays</label>
                        <select wire:model="country" class="bg-gray-100 px-3 py-2 border rounded w-full">
                            <option value="France">France</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Canada">Canada</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">Adresse e-mail</label>
                        <input type="email" wire:model="email" class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('email')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700">Mot de passe</label>
                        <input type="password" wire:model="password"
                            class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('password')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" wire:model="password_confirmation"
                            class="bg-gray-100 px-3 py-2 border rounded w-full">
                    </div>
                </div>
            @endif
        @else
            <!-- Utilisateur déjà connecté: Vérification des informations -->
            <div class="bg-gray-50 mb-6 p-4 rounded-lg">
                <h3 class="mb-2 font-semibold text-lg">Informations personnelles</h3>
                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label class="block text-gray-700">Prénom</label>
                        <input type="text" wire:model="first_name"
                            class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('first_name')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Nom</label>
                        <input type="text" wire:model="last_name"
                            class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('last_name')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block text-gray-700">Téléphone</label>
                    <input type="text" wire:model="phone" class="bg-gray-100 px-3 py-2 border rounded w-full">
                    @error('phone')
                        <span class="text-emerald-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-3">
                    <label class="block text-gray-700">Adresse</label>
                    <input type="text" wire:model="address" class="bg-gray-100 px-3 py-2 border rounded w-full">
                    @error('address')
                        <span class="text-emerald-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="gap-4 grid grid-cols-2 mt-3">
                    <div>
                        <label class="block text-gray-700">Code postal</label>
                        <input type="text" wire:model="postal_code" class="bg-gray-100 px-3 py-2 border rounded">
                        @error('postal_code')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Ville</label>
                        <input type="text" wire:model="city" class="bg-gray-100 px-3 py-2 border rounded">
                        @error('city')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
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
                <div class="space-y-4 mt-4 p-4 border rounded-lg">
                    <h3 class="font-semibold">Adresse de livraison</h3>
                    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <label class="block text-gray-700">Prénom</label>
                            <input type="text" wire:model="shipping_first_name"
                                class="bg-gray-100 px-3 py-2 border rounded w-full">
                            @error('shipping_first_name')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Nom</label>
                            <input type="text" wire:model="shipping_last_name"
                                class="bg-gray-100 px-3 py-2 border rounded w-full">
                            @error('shipping_last_name')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Adresse</label>
                        <input type="text" wire:model="shipping_address"
                            class="bg-gray-100 px-3 py-2 border rounded w-full">
                        @error('shipping_address')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block text-gray-700">Code postal</label>
                            <input type="text" wire:model="shipping_postal_code"
                                class="bg-gray-100 px-3 py-2 border rounded">
                            @error('shipping_postal_code')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Ville</label>
                            <input type="text" wire:model="shipping_city"
                                class="bg-gray-100 px-3 py-2 border rounded">
                            @error('shipping_city')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Pays</label>
                        <select wire:model="shipping_country" class="bg-gray-100 px-3 py-2 border rounded w-full">
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
            <a href="{{ route('cart') }}" class="text-emerald-600 hover:underline">« Panier</a>
            <button wire:click="goToNextStep"
                class="bg-emerald-600 hover:bg-emerald-300 px-6 py-2 rounded text-white">Suivant »</button>
        </div>

        <!-- ÉTAPE 2: Mode de paiement -->
    @elseif ($step === 2)
        <div class="space-y-6">
            <h2 class="font-semibold text-xl">Informations de paiement</h2>

            <div class="space-y-4">
                @if ($account)
                    <div class="bg-gray-50 p-4 border border-gray-300 rounded-lg">
                        <h3 class="mb-3 font-semibold text-lg">Virement bancaire</h3>

                        <div class="bg-white shadow-sm mb-4 p-4 border border-gray-200 rounded-lg">
                            <div class="space-y-4">
                                <div class="space-y-3">
                                    <h5 class="pb-2 border-gray-200 border-b font-semibold text-gray-800 text-sm">
                                        Informations bancaires</h5>
                                    <div class="space-y-2">
                                        <div class="flex sm:flex-row flex-col sm:items-center">
                                            <span
                                                class="mb-1 sm:mb-0 w-full sm:w-24 font-semibold text-gray-700 text-sm">Banque:</span>
                                            <span
                                                class="font-medium text-gray-900 text-sm break-all">{{ $account->bank ?? 'Non renseigné' }}</span>
                                        </div>
                                        <div class="flex sm:flex-row flex-col sm:items-center">
                                            <span
                                                class="mb-1 sm:mb-0 w-full sm:w-24 font-semibold text-gray-700 text-sm">IBAN:</span>
                                            <span
                                                class="font-mono text-gray-900 text-sm break-all">{{ $account->iban ?? 'Non renseigné' }}</span>
                                        </div>
                                        <div class="flex sm:flex-row flex-col sm:items-center">
                                            <span
                                                class="mb-1 sm:mb-0 w-full sm:w-24 font-semibold text-gray-700 text-sm">BIC/SWIFT:</span>
                                            <span
                                                class="font-mono text-gray-900 text-sm break-all">{{ $account->swift ?? 'Non renseigné' }}</span>
                                        </div>
                                        <div class="flex sm:flex-row flex-col sm:items-center">
                                            <span
                                                class="mb-1 sm:mb-0 w-full sm:w-24 font-semibold text-gray-700 text-sm">Bénéficiaire:</span>
                                            <span
                                                class="font-medium text-gray-900 text-sm break-all uppercase">{{ $account->owner ?? 'Non renseigné' }}</span>
                                        </div>
                                        <div class="flex sm:flex-row flex-col sm:items-center">
                                            <span
                                                class="mb-1 sm:mb-0 w-full sm:w-24 font-semibold text-gray-700 text-sm">Adresse:</span>
                                            <span
                                                class="text-gray-900 text-sm break-all">{{ $account->address ?? 'Non renseigné' }}</span>
                                        </div>
                                        <div class="flex sm:flex-row flex-col sm:items-center">
                                            <span
                                                class="mb-1 sm:mb-0 w-full sm:w-24 font-semibold text-gray-700 text-sm">Pays:</span>
                                            <span
                                                class="text-gray-900 text-sm break-all">{{ $account->country ?? 'Non renseigné' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="mt-2 text-gray-600 text-sm">
                            Veuillez effectuer un virement bancaire en utilisant les coordonnées ci-dessus.
                            N'oubliez pas d'inclure votre nom et prénom dans la référence du virement.
                        </p>
                    </div>
                @else
                    <div class="bg-yellow-50 p-4 border border-yellow-300 rounded-lg">
                        <p class="text-yellow-700">Aucun compte bancaire n'est disponible pour le moment. Veuillez
                            nous contacter pour plus d'informations.</p>
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <label class="block text-gray-700">Notes pour la commande (optionnel)</label>
                <textarea wire:model="notes" rows="3" class="bg-gray-100 px-3 py-2 border rounded w-full"></textarea>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-6">
                <button wire:click="goToPreviousStep" class="text-emerald-600 hover:underline">« Retour</button>
                <button wire:click="goToNextStep"
                    class="bg-emerald-600 hover:bg-emerald-300 px-6 py-2 rounded text-white"
                    {{ !$account ? 'disabled' : '' }}>
                    Vérifier la commande »
                </button>
            </div>
        </div>

        <!-- ÉTAPE 3: Confirmation -->
    @elseif ($step === 3)
        <div class="space-y-6">
            <h2 class="font-semibold text-xl">Vérification de votre commande</h2>

            <!-- Récapitulatif des articles -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="mb-3 pb-2 border-b font-semibold">Articles commandés</h3>

                <div class="space-y-3">
                    @if (auth()->check())
                        @foreach ($cartItems as $item)
                            <div class="flex items-center space-x-3 py-2 border-b">
                                <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                    alt="{{ $item['product']['name'] }}" class="rounded w-12 h-12 object-cover">
                                <div class="flex-1">
                                    <h4 class="font-medium text-sm">{{ $item['product']['name'] }}</h4>
                                    <p class="text-gray-500 text-xs">Quantité: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="font-medium text-emerald-700">
                                    {{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }}€
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($cartItems as $item)
                            <div class="flex items-center space-x-3 py-2 border-b">
                                <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                    alt="{{ $item['product']['name'] }}" class="rounded w-12 h-12 object-cover">
                                <div class="flex-1">
                                    <h4 class="font-medium text-sm">{{ $item['product']['name'] }}</h4>
                                    <p class="text-gray-500 text-xs">Quantité: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="font-medium text-emerald-700">
                                    {{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }}€
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="space-y-2 mt-4">
                    <div class="flex justify-between text-sm">
                        <span>Sous-total:</span>
                        <span>{{ number_format($subTotal, 2, ',', ' ') }}€</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Frais de livraison:</span>
                        <span>{{ number_format($shippingCost, 2, ',', ' ') }}€</span>
                    </div>
                    <div class="flex justify-between pt-2 border-t font-bold text-lg">
                        <span>Total:</span>
                        <span>{{ number_format($total, 2, ',', ' ') }}€</span>
                    </div>
                </div>
            </div>

            <!-- Récapitulatif client -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="mb-3 pb-2 border-b font-semibold">Informations de facturation</h3>
                <p>{{ $first_name }} {{ $last_name }}</p>
                <p>{{ $address }}</p>
                <p>{{ $postal_code }} {{ $city }}</p>
                <p>{{ $country }}</p>
                <p>{{ $email }}</p>
                <p>{{ $phone }}</p>
            </div>

            @if ($use_different_shipping)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="mb-3 pb-2 border-b font-semibold">Informations de livraison</h3>
                    <p>{{ $shipping_first_name }} {{ $shipping_last_name }}</p>
                    <p>{{ $shipping_address }}</p>
                    <p>{{ $shipping_postal_code }} {{ $shipping_city }}</p>
                    <p>{{ $shipping_country }}</p>
                </div>
            @endif

            <!-- Méthode de paiement -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="mb-3 pb-2 border-b font-semibold">Méthode de paiement</h3>
                <p class="mb-2">Virement bancaire</p>

                @if ($account)
                    <div class="bg-yellow-50 mb-4 p-4 border border-yellow-200 rounded-lg">
                        <h4 class="mb-2 font-semibold text-yellow-800">Coordonnées bancaires</h4>
                        <div class="space-y-2">
                            <div class="flex">
                                <span class="w-32 font-medium text-gray-600">Bénéficiaire:</span>
                                <span class="text-slate-700 uppercase">{{ $account->owner }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-medium text-gray-600">IBAN:</span>
                                <span class="font-mono text-slate-700 uppercase">{{ $account->iban }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-medium text-gray-600">BIC/SWIFT:</span>
                                <span class="font-mono text-slate-700 uppercase">{{ $account->swift }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-medium text-gray-600">Banque:</span>
                                <span class="text-slate-700">{{ $account->bank }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-medium text-gray-600">Adresse:</span>
                                <span class="text-slate-700">{{ $account->address }}</span>
                            </div>
                            @if ($account->country)
                                <div class="flex">
                                    <span class="w-32 font-medium text-gray-600">Pays:</span>
                                    <span class="text-slate-700">{{ $account->country }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Upload de justificatif -->
                <div class="mt-4">
                    <h4 class="mb-2 font-semibold">Justificatif de paiement</h4>
                    <div class="p-4 border-2 border-gray-300 border-dashed rounded-lg text-center">
                        @if ($has_proof)
                            <p class="mb-2 text-emerald-600"><i class="mr-2 fas fa-check-circle"></i>Justificatif
                                téléchargé</p>
                            <button wire:click="$set('has_proof', false)"
                                class="text-emerald-600 text-sm hover:underline">
                                Changer de fichier
                            </button>
                        @else
                            <label for="payment_proof" class="block cursor-pointer">
                                <i class="mb-2 text-gray-400 text-xl fas fa-upload"></i>
                                <p class="mb-1 text-gray-500 text-sm">Cliquez pour télécharger un justificatif de
                                    paiement</p>
                                <p class="text-gray-400 text-xs">(Formats acceptés: JPG, PNG, PDF - Max 10Mo)</p>
                                <input type="file" id="payment_proof" wire:model="payment_proof" class="hidden"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </label>
                            @error('payment_proof')
                                <p class="mt-2 text-emerald-500 text-xs">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-6">
                <button wire:click="goToPreviousStep" class="text-emerald-600 hover:underline">« Retour</button>
                <button wire:click="createOrder"
                    class="bg-emerald-600 hover:bg-emerald-300 disabled:bg-gray-400 px-6 py-2 rounded text-white disabled:cursor-not-allowed"
                    {{ !$has_proof ? 'disabled' : '' }} wire:loading.attr="disabled" wire:target="createOrder">
                    <span wire:loading.remove wire:target="createOrder">
                        {{ !$has_proof ? 'Télécharger un justificatif pour continuer' : 'Confirmer la commande' }}
                    </span>
                    <span wire:loading wire:target="createOrder" class="flex items-center">
                        <svg class="mr-2 -ml-1 w-4 h-4 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
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

<div class="mx-auto px-4 py-8 container">
    <div class="mx-auto max-w-4xl">
        <!-- Navigation Tabs -->
        <div class="flex mb-6 border-b">
            <a href="{{ route('profile') }}"
                class="px-6 py-2 font-medium {{ request()->routeIs('profile') ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-500 hover:text-emerald-600' }}">
                Mon Profil
            </a>
            <a href="{{ route('order-history') }}"
                class="px-6 py-2 font-medium {{ request()->routeIs('order-history') ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-500 hover:text-emerald-600' }}">
                Historique des commandes
            </a>
        </div>

        <div class="bg-white shadow-sm p-6 rounded-lg">
            <h2 class="mb-6 font-semibold text-2xl">Informations personnelles</h2>

            <!-- Personal Information Form -->
            <form wire:submit="updateProfile" class="space-y-6">
                <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Nom d'utilisateur</label>
                        <input type="text" wire:model="name"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('name')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Email</label>
                        <input type="email" wire:model="email"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('email')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Prénom</label>
                        <input type="text" wire:model="first_name"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('first_name')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Nom</label>
                        <input type="text" wire:model="last_name"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('last_name')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Téléphone</label>
                        <input type="text" wire:model="phone"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('phone')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Adresse</label>
                        <input type="text" wire:model="address"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('address')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Code postal</label>
                        <input type="text" wire:model="postal_code"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('postal_code')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Ville</label>
                        <input type="text" wire:model="city"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('city')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Pays</label>
                        <select wire:model="country" class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                            <option value="France">France</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Canada">Canada</option>
                        </select>
                        @error('country')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-300 px-4 py-2 rounded-md text-white">
                        Mettre à jour le profil
                    </button>
                </div>
            </form>

            <!-- Password Change Section -->
            <div class="mt-10 pt-6 border-t">
                <h3 class="mb-4 font-semibold text-xl">Changer le mot de passe</h3>
                <form wire:submit="updatePassword" class="space-y-4">
                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Mot de passe actuel</label>
                        <input type="password" wire:model="current_password"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('current_password')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Nouveau mot de passe</label>
                        <input type="password" wire:model="new_password"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                        @error('new_password')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 text-sm">Confirmer le nouveau mot de passe</label>
                        <input type="password" wire:model="new_password_confirmation"
                            class="block shadow-sm mt-1 border-gray-300 rounded-md w-full">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-300 px-4 py-2 rounded-md text-white">
                            Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

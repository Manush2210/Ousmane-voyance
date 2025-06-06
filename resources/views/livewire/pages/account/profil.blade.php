<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Navigation Tabs -->
        <div class="flex border-b mb-6">
            <a href="{{ route('profile') }}"
                class="px-6 py-2 font-medium {{ request()->routeIs('profile') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-purple-600' }}">
                Mon Profil
            </a>
            <a href="{{ route('order-history') }}"
                class="px-6 py-2 font-medium {{ request()->routeIs('order-history') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-purple-600' }}">
                Historique des commandes
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-6">Informations personnelles</h2>

            <!-- Personal Information Form -->
            <form wire:submit="updateProfile" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
                        <input type="text" wire:model="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('name')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" wire:model="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('email')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prénom</label>
                        <input type="text" wire:model="first_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('first_name')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" wire:model="last_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('last_name')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="text" wire:model="phone"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('phone')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" wire:model="address"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('address')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Code postal</label>
                        <input type="text" wire:model="postal_code"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('postal_code')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ville</label>
                        <input type="text" wire:model="city"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('city')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pays</label>
                        <select wire:model="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="France">France</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Canada">Canada</option>
                        </select>
                        @error('country')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-300">
                        Mettre à jour le profil
                    </button>
                </div>
            </form>

            <!-- Password Change Section -->
            <div class="mt-10 pt-6 border-t">
                <h3 class="text-xl font-semibold mb-4">Changer le mot de passe</h3>
                <form wire:submit="updatePassword" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <input type="password" wire:model="current_password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('current_password')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                        <input type="password" wire:model="new_password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('new_password')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                        <input type="password" wire:model="new_password_confirmation"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-300">
                            Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

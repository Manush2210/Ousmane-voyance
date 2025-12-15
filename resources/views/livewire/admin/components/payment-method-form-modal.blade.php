<div>
    @if ($isOpen)
        <div class="z-50 fixed inset-0 overflow-y-auto">
            <div class="sm:block flex justify-center items-center sm:p-0 px-4 pt-4 pb-20 min-h-screen text-center">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>

                <div
                    class="inline-block bg-gray-800 shadow-xl sm:my-8 rounded-lg sm:w-full sm:max-w-2xl overflow-hidden text-left sm:align-middle align-bottom transition-all transform">
                    <div class="bg-gray-800 sm:p-6 px-4 pt-5 pb-4 sm:pb-4">
                        <div class="mb-4 text-white">
                            <h3 class="mb-2 font-medium text-lg">
                                {{ $editMode ? 'Modifier le moyen de paiement' : 'Ajouter un moyen de paiement' }}
                            </h3>
                            <p class="text-gray-400 text-sm">
                                {{ $editMode ? 'Modifier les détails du moyen de paiement.' : 'Ajouter un nouveau moyen de paiement.' }}
                            </p>
                        </div>

                        <form wire:submit="save" class="space-y-4">
                            <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                                <div>
                                    <label for="name" class="block font-medium text-gray-300 text-sm">Nom</label>
                                    <input type="text" id="name" wire:model="name"
                                        class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="code" class="block font-medium text-gray-300 text-sm">Code</label>
                                    <input type="text" id="code" wire:model="code"
                                        {{ $editMode ? '' : 'readonly' }}
                                        class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 {{ $editMode ? '' : 'opacity-70' }}">
                                    @error('code')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="description"
                                    class="block font-medium text-gray-300 text-sm">Description</label>
                                <textarea id="description" wire:model="description" rows="3"
                                    class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="instructions"
                                    class="block font-medium text-gray-300 text-sm">Instructions</label>
                                <textarea id="instructions" wire:model="instructions" rows="3"
                                    class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white"></textarea>
                                @error('instructions')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="motifs" class="block font-medium text-gray-300 text-sm">Motifs</label>
                                <textarea id="motifs" wire:model="motifs" rows="3"
                                    class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white"></textarea>
                                @error('motifs')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Receiver Information Section -->
                            <div class="mt-4 pt-4 border-gray-600 border-t">
                                <h4 class="mb-3 font-medium text-gray-300 text-md">Informations du destinataire</h4>

                                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                                    <div>
                                        <label for="receiver_firstname"
                                            class="block font-medium text-gray-300 text-sm">Prénom du
                                            destinataire</label>
                                        <input type="text" id="receiver_firstname" wire:model="receiver_firstname"
                                            class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white">
                                        @error('receiver_firstname')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="receiver_lastname"
                                            class="block font-medium text-gray-300 text-sm">Nom du destinataire</label>
                                        <input type="text" id="receiver_lastname" wire:model="receiver_lastname"
                                            class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white">
                                        @error('receiver_lastname')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label for="receiver_country" class="block font-medium text-gray-300 text-sm">Pays
                                        du destinataire</label>
                                    <input type="text" id="receiver_country" wire:model="receiver_country"
                                        class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white">
                                    @error('receiver_country')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <label for="address"
                                        class="block font-medium text-gray-300 text-sm">Adresse</label>
                                    <textarea id="address" wire:model="address" rows="3"
                                        class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white"></textarea>
                                    @error('address')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-300 text-sm">Logo</label>
                                <div class="flex items-center space-x-4 mt-1">
                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" alt="Preview"
                                            class="rounded-lg w-20 h-20 object-cover">
                                    @elseif ($currentLogo)
                                        <img src="{{ Storage::url($currentLogo) }}" alt="Current Logo"
                                            class="rounded-lg w-20 h-20 object-cover">
                                    @else
                                        <div class="flex justify-center items-center bg-gray-600 rounded-lg w-20 h-20">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <label for="logo-upload"
                                        class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-md text-white cursor-pointer">
                                        <span>Choisir une image</span>
                                        <input id="logo-upload" wire:model="logo" type="file" class="sr-only"
                                            accept="image/*">
                                    </label>
                                </div>
                                @error('logo')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <input id="is_active" type="checkbox" wire:model="is_active"
                                    class="bg-gray-700 border-gray-600 rounded focus:ring-emerald-500 w-4 h-4 text-emerald-500">
                                <label for="is_active" class="block ml-2 text-gray-300 text-sm">
                                    Actif
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="sm:flex sm:flex-row-reverse bg-gray-700 px-4 sm:px-6 py-3">
                        <button wire:click="save" type="button"
                            class="inline-flex justify-center bg-emerald-500 hover:bg-emerald-600 shadow-sm sm:ml-3 px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 w-full sm:w-auto font-medium text-white sm:text-sm text-base">
                            {{ $editMode ? 'Mettre à jour' : 'Ajouter' }}
                        </button>
                        <button wire:click="closeModal" type="button"
                            class="inline-flex justify-center bg-gray-800 hover:bg-gray-700 shadow-sm mt-3 sm:mt-0 sm:ml-3 px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 w-full sm:w-auto font-medium text-gray-300 sm:text-sm text-base">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

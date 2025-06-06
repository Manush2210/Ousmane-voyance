<div>
    @if ($isOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>

                <div
                    class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4 text-white">
                            <h3 class="text-lg font-medium mb-2">
                                {{ $editMode ? 'Modifier le moyen de paiement' : 'Ajouter un moyen de paiement' }}
                            </h3>
                            <p class="text-sm text-gray-400">
                                {{ $editMode ? 'Modifier les détails du moyen de paiement.' : 'Ajouter un nouveau moyen de paiement.' }}
                            </p>
                        </div>

                        <form wire:submit="save" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-300">Nom</label>
                                    <input type="text" id="name" wire:model="name"
                                        class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="code" class="block text-sm font-medium text-gray-300">Code</label>
                                    <input type="text" id="code" wire:model="code"
                                        {{ $editMode ? '' : 'readonly' }}
                                        class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 {{ $editMode ? '' : 'opacity-70' }}">
                                    @error('code')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-gray-300">Description</label>
                                <textarea id="description" wire:model="description" rows="3"
                                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="instructions"
                                    class="block text-sm font-medium text-gray-300">Instructions</label>
                                <textarea id="instructions" wire:model="instructions" rows="3"
                                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500"></textarea>
                                @error('instructions')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="motifs" class="block text-sm font-medium text-gray-300">Motifs</label>
                                <textarea id="motifs" wire:model="motifs" rows="3"
                                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500"></textarea>
                                @error('motifs')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Receiver Information Section -->
                            <div class="border-t border-gray-600 pt-4 mt-4">
                                <h4 class="text-md font-medium text-gray-300 mb-3">Informations du destinataire</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="receiver_firstname"
                                            class="block text-sm font-medium text-gray-300">Prénom du
                                            destinataire</label>
                                        <input type="text" id="receiver_firstname" wire:model="receiver_firstname"
                                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                        @error('receiver_firstname')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="receiver_lastname"
                                            class="block text-sm font-medium text-gray-300">Nom du destinataire</label>
                                        <input type="text" id="receiver_lastname" wire:model="receiver_lastname"
                                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                        @error('receiver_lastname')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label for="receiver_country" class="block text-sm font-medium text-gray-300">Pays
                                        du destinataire</label>
                                    <input type="text" id="receiver_country" wire:model="receiver_country"
                                        class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    @error('receiver_country')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <label for="address"
                                        class="block text-sm font-medium text-gray-300">Adresse</label>
                                    <textarea id="address" wire:model="address" rows="3"
                                        class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500"></textarea>
                                    @error('address')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300">Logo</label>
                                <div class="mt-1 flex items-center space-x-4">
                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" alt="Preview"
                                            class="h-20 w-20 object-cover rounded-lg">
                                    @elseif ($currentLogo)
                                        <img src="{{ Storage::url($currentLogo) }}" alt="Current Logo"
                                            class="h-20 w-20 object-cover rounded-lg">
                                    @else
                                        <div class="h-20 w-20 rounded-lg bg-gray-600 flex items-center justify-center">
                                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <label for="logo-upload"
                                        class="cursor-pointer px-4 py-2 bg-gray-700 rounded-md text-white hover:bg-gray-600">
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
                                    class="h-4 w-4 text-purple-500 focus:ring-purple-500 border-gray-600 rounded bg-gray-700">
                                <label for="is_active" class="ml-2 block text-sm text-gray-300">
                                    Actif
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="save" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-500 text-base font-medium text-white hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ $editMode ? 'Mettre à jour' : 'Ajouter' }}
                        </button>
                        <button wire:click="closeModal" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-600 shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

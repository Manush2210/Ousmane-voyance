<div>
    @if ($isOpen)
        <div class="fixed inset-0 backdrop-blur-sm overflow-y-auto h-full w-full z-50"
            style="background-color: rgba(0, 0, 0, 0.265)">
            <div class="relative top-5 mx-auto p-5 border w-full max-w-xl shadow-lg rounded-md bg-gray-800">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-white/90">
                        {{ $editMode ? 'Modifier le Produit' : 'Ajouter un Produit' }}
                    </h3>
                    <button wire:click="closeModal" class="text-white/50 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    @if (session()->has('message'))
                        <div class="bg-purple-300 text-white p-4 rounded-md">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div>
                        <label class="block text-white/50 mb-2">Nom</label>
                        <input type="text" wire:model="name" class="w-full bg-gray-900 text-white rounded-md p-2">
                        @error('name')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/50 mb-2">Description</label>
                        <textarea wire:model="description" class="w-full bg-gray-900 text-white rounded-md p-2" rows="4"></textarea>
                        @error('description')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-white/50 mb-2">Prix</label>
                            <input type="number" wire:model="price" step="0.01"
                                class="w-full bg-gray-900 text-white rounded-md p-2">
                            @error('price')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-white/50 mb-2">Stock</label>
                            <input type="number" wire:model="stock"
                                class="w-full bg-gray-900 text-white rounded-md p-2">
                            @error('stock')
                                <span class="text-purple-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-white">
                            Images (Maximum 5)
                        </label>
                        <div class="flex gap-4 flex-wrap items-center">
                            <input type="file" wire:model="image"
                                class="block w-full text-sm text-gray-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-gray-700 file:text-white
                            hover:file:bg-gray-600"
                                accept="image/*" {{ count($tempImages) >= 5 ? 'disabled' : '' }} />
                            @if (count($tempImages) >= 5)
                                <span class="text-yellow-500 text-sm">Nombre maximum d'images atteint</span>
                            @endif
                        </div>
                        @error('image')
                            <span class="text-purple-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-4 flex-wrap">
                        @if ($tempImages)
                            @foreach ($tempImages as $index => $image)
                                <div class="relative">
                                    <img src="{{ is_string($image) ? Storage::url($image) : $image->temporaryUrl() }}"
                                        class="h-24 w-24 object-cover rounded-lg">
                                    <button type="button" wire:click="removeImage({{ $index }})"
                                        class="absolute -top-2 -right-2 bg-purple-500 text-white rounded-full p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" wire:model="is_active" class="bg-gray-900 rounded">
                        <label class="ml-2 text-white/50">Actif</label>
                    </div>

                    <div class="flex justify-end gap-4">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            {{ $editMode ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

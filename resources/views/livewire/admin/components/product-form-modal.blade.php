<div>
    @if ($isOpen)
        <div class="z-50 fixed inset-0 backdrop-blur-sm w-full h-full overflow-y-auto"
            style="background-color: rgba(0, 0, 0, 0.265)">
            <div class="top-5 relative bg-gray-800 shadow-lg mx-auto p-5 border rounded-md w-full max-w-xl">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-white/90 text-xl">
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
                        <div class="bg-emerald-300 p-4 rounded-md text-white">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div>
                        <label class="block mb-2 text-white/50">Nom</label>
                        <input type="text" wire:model="name" class="bg-gray-900 p-2 rounded-md w-full text-white">
                        @error('name')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-white/50">Description</label>
                        <textarea wire:model="description" class="bg-gray-900 p-2 rounded-md w-full text-white" rows="4"></textarea>
                        @error('description')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block mb-2 text-white/50">Prix</label>
                            <input type="number" wire:model="price" step="0.01"
                                class="bg-gray-900 p-2 rounded-md w-full text-white">
                            @error('price')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-white/50">Stock</label>
                            <input type="number" wire:model="stock"
                                class="bg-gray-900 p-2 rounded-md w-full text-white">
                            @error('stock')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block font-medium text-white text-sm">
                            Images (Maximum 5)
                        </label>
                        <div class="flex flex-wrap items-center gap-4">
                            <input type="file" wire:model="image"
                                class="block hover:file:bg-gray-600 file:bg-gray-700 file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-md w-full file:font-semibold text-gray-400 file:text-white text-sm file:text-sm"
                                accept="image/*" {{ count($tempImages) >= 5 ? 'disabled' : '' }} />
                            @if (count($tempImages) >= 5)
                                <span class="text-yellow-500 text-sm">Nombre maximum d'images atteint</span>
                            @endif
                        </div>
                        @error('image')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-4">
                        @if ($tempImages)
                            @foreach ($tempImages as $index => $image)
                                <div class="relative">
                                    <img src="{{ is_string($image) ? Storage::url($image) : $image->temporaryUrl() }}"
                                        class="rounded-lg w-24 h-24 object-cover">
                                    <button type="button" wire:click="removeImage({{ $index }})"
                                        class="-top-2 -right-2 absolute bg-emerald-500 p-1 rounded-full text-white">
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
                            class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-white">
                            Annuler
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md text-white">
                            {{ $editMode ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

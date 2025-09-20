<div x-data="{ show: @entangle('isOpen') }" x-show="show" class="z-50 fixed inset-0 overflow-y-auto" style="display: none;">
    <div class="sm:block flex justify-center items-center sm:p-0 px-4 pt-4 pb-20 min-h-screen text-center">
        <div x-show="show" class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

        <div x-show="show"
            class="inline-block bg-gray-900 shadow-xl sm:my-8 rounded-lg sm:w-full sm:max-w-lg overflow-hidden text-left sm:align-middle align-bottom transition-all transform">
            <form wire:submit.prevent="save">
                <div class="bg-gray-900 sm:p-6 px-4 pt-5 pb-4 sm:pb-4">
                    <div class="mb-4">
                        <h3 class="font-medium text-white text-lg leading-6">
                            {{ $editMode ? 'Modifier le type de consultation' : 'Nouveau type de consultation' }}
                        </h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block font-medium text-gray-300 text-sm">Nom</label>
                            <input type="text" wire:model="name" id="name"
                                class="block bg-gray-800 shadow-sm mt-1 border-gray-700 focus:border-teal-500 rounded-md focus:ring-teal-500 w-full text-white sm:text-sm">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block font-medium text-gray-300 text-sm">Description</label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="block bg-gray-800 shadow-sm mt-1 border-gray-700 focus:border-teal-500 rounded-md focus:ring-teal-500 w-full text-white sm:text-sm"></textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block font-medium text-gray-300 text-sm">Prix</label>
                            <input type="number" step="0.01" wire:model="price" id="price"
                                class="block bg-gray-800 shadow-sm mt-1 border-gray-700 focus:border-teal-500 rounded-md focus:ring-teal-500 w-full text-white sm:text-sm">
                            @error('price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="block font-medium text-gray-300 text-sm">Image</label>
                            <input type="file" wire:model="image" id="image"
                                class="block hover:file:bg-teal-100 file:bg-teal-50 mt-1 file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-md w-full file:font-semibold text-gray-300 file:text-teal-700 text-sm file:text-sm">
                            @error('image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            @if ($currentImage)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($currentImage) }}" alt="Image actuelle"
                                        class="rounded w-20 h-20 object-cover">
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" wire:model="is_active" id="is_active"
                                class="bg-gray-800 border-gray-700 rounded focus:ring-teal-500 w-4 h-4 text-teal-600">
                            <label for="is_active" class="block ml-2 text-gray-300 text-sm">Actif</label>
                        </div>
                    </div>
                </div>

                <div class="sm:flex sm:flex-row-reverse bg-gray-800 px-4 sm:px-6 py-3">
                    <button type="submit"
                        class="inline-flex justify-center bg-teal-600 hover:bg-teal-700 shadow-sm sm:ml-3 px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 w-full sm:w-auto font-medium text-white sm:text-sm text-base">
                        {{ $editMode ? 'Mettre à jour' : 'Créer' }}
                    </button>
                    <button type="button" wire:click="closeModal"
                        class="inline-flex justify-center bg-gray-800 hover:bg-gray-700 shadow-sm mt-3 sm:mt-0 sm:ml-3 px-4 py-2 border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 w-full sm:w-auto font-medium text-gray-300 sm:text-sm text-base">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

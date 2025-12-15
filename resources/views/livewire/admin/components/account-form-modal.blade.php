<div>
    @if ($isOpen)
        <div class="z-50 fixed inset-0 backdrop-blur-sm w-full h-full overflow-y-auto"
            style="background-color: rgba(0, 0, 0, 0.265)">
            <div class="top-5 relative bg-gray-800 shadow-lg mx-auto p-5 border rounded-md w-full max-w-xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-white/90 text-xl">
                        {{ $editMode ? 'Modifier le Compte' : 'Ajouter un Compte' }}
                    </h3>
                    <button wire:click="closeModal" class="text-white/50 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block mb-2 text-white/50">Propriétaire</label>
                        <input type="text" wire:model="owner" class="bg-gray-900 p-2 rounded-md w-full text-white">
                        @error('owner')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-white/50">Banque</label>
                        <input type="text" wire:model="bank" class="bg-gray-900 p-2 rounded-md w-full text-white">
                        @error('bank')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block mb-2 text-white/50">IBAN</label>
                            <input type="text" wire:model="iban"
                                class="bg-gray-900 p-2 rounded-md w-full text-white">
                            @error('iban')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-white/50">SWIFT</label>
                            <input type="text" wire:model="swift"
                                class="bg-gray-900 p-2 rounded-md w-full text-white">
                            @error('swift')
                                <span class="text-emerald-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-white/50">Adresse</label>
                        <textarea wire:model="address" class="bg-gray-900 p-2 rounded-md w-full text-white" rows="3"></textarea>
                        @error('address')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-white/50">Pays</label>
                        <input type="text" wire:model="country" class="bg-gray-900 p-2 rounded-md w-full text-white">
                        @error('country')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-white/50">Prix des rendez-vous</label>
                        <input type="text" wire:model.live="appointment_pricing"
                            class="bg-gray-900 p-2 rounded-md w-full text-white">
                        @error('country')
                            <span class="text-emerald-500 text-sm">{{ $message }}</span>
                        @enderror
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

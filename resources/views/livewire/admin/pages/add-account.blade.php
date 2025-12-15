<div class="flex-1 mx-auto px-4 sm:px-6 py-4 md:py-8 max-w-4xl overflow-hidden">
    <div class="mb-6">
        <h3 class="font-medium text-white/90 text-2xl">Compte Bancaire</h3>
        <p class="mt-1 text-white/60">Gérez les informations de votre compte bancaire</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-300 mb-6 p-4 rounded-md text-white">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        @if ($account)
            <div class="p-4 sm:p-6">
                <div class="space-y-4">
                    <!-- Status -->
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-white text-lg">Informations du compte</h4>
                        @if ($account->is_active)
                            <span class="bg-emerald-100 px-3 py-1 rounded-full font-medium text-emerald-800 text-sm">
                                Actif
                            </span>
                        @else
                            <span class="bg-emerald-100 px-3 py-1 rounded-full font-medium text-emerald-800 text-sm">
                                Inactif
                            </span>
                        @endif
                    </div>

                    <!-- Account Details -->
                    <div class="gap-4 grid text-white/80">
                        <div class="bg-gray-700/50 p-4 rounded-lg">
                            <div class="mb-1 text-white/60 text-sm">Propriétaire</div>
                            <div>{{ $account->owner }}</div>
                        </div>

                        <div class="bg-gray-700/50 p-4 rounded-lg">
                            <div class="mb-1 text-white/60 text-sm">Banque</div>
                            <div>{{ $account->bank }}</div>
                        </div>

                        <div class="bg-gray-700/50 p-4 rounded-lg">
                            <div class="mb-1 text-white/60 text-sm">IBAN</div>
                            <div class="font-mono">{{ $account->iban }}</div>
                        </div>

                        <div class="bg-gray-700/50 p-4 rounded-lg">
                            <div class="mb-1 text-white/60 text-sm">SWIFT</div>
                            <div class="font-mono">{{ $account->swift }}</div>
                        </div>

                        <div class="bg-gray-700/50 p-4 rounded-lg">
                            <div class="mb-1 text-white/60 text-sm">Pays</div>
                            <div>{{ $account->country }}</div>
                        </div>
                        <div class="bg-gray-700/50 p-4 rounded-lg">
                            <div class="mb-1 text-white/60 text-sm">Prix de RDV</div>
                            <div>{{ $account->appointment_pricing ?? 0 }}</div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-6">
                            <button wire:click="$dispatch('openModal', { accountId: {{ $account->id }} })"
                                class="flex justify-center items-center gap-2 bg-blue-500 hover:bg-blue-600 px-4 py-3 rounded-lg w-full font-medium text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Modifier les informations
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6 text-center">
                    <div class="mb-4 text-white/60">Aucun compte bancaire n'est configuré</div>
                    <button wire:click="$dispatch('openModal')"
                        class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg font-medium text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Configurer le compte bancaire
                    </button>
                </div>
        @endif
    </div>

    <livewire:admin.components.account-form-modal />
</div>

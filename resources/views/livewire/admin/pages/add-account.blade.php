<div class="flex-1 px-4 sm:px-6 py-4 md:py-8 overflow-hidden max-w-4xl mx-auto">
    <div class="mb-6">
        <h3 class="text-2xl font-medium text-white/90">Compte Bancaire</h3>
        <p class="text-white/60 mt-1">Gérez les informations de votre compte bancaire</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-6">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        @if($account)
            <div class="p-4 sm:p-6">
                <div class="space-y-4">
                    <!-- Status -->
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-medium text-white">Informations du compte</h4>
                        @if ($account->is_active)
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                Actif
                            </span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                Inactif
                            </span>
                        @endif
                    </div>

                    <!-- Account Details -->
                    <div class="grid gap-4 text-white/80">
                        <div class="p-4 bg-gray-700/50 rounded-lg">
                            <div class="text-sm text-white/60 mb-1">Propriétaire</div>
                            <div>{{ $account->owner }}</div>
                        </div>

                        <div class="p-4 bg-gray-700/50 rounded-lg">
                            <div class="text-sm text-white/60 mb-1">Banque</div>
                            <div>{{ $account->bank }}</div>
                        </div>

                        <div class="p-4 bg-gray-700/50 rounded-lg">
                            <div class="text-sm text-white/60 mb-1">IBAN</div>
                            <div class="font-mono">{{ $account->iban }}</div>
                        </div>

                        <div class="p-4 bg-gray-700/50 rounded-lg">
                            <div class="text-sm text-white/60 mb-1">SWIFT</div>
                            <div class="font-mono">{{ $account->swift }}</div>
                        </div>

                        <div class="p-4 bg-gray-700/50 rounded-lg">
                            <div class="text-sm text-white/60 mb-1">Pays</div>
                            <div>{{ $account->country }}</div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-6">
                        <button
                            wire:click="$dispatch('openModal', { accountId: {{ $account->id }} })"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Modifier les informations
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="p-6 text-center">
                <div class="text-white/60 mb-4">Aucun compte bancaire n'est configuré</div>
                <button
                    wire:click="$dispatch('openModal')"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Configurer le compte bancaire
                </button>
            </div>
        @endif
    </div>

    <livewire:admin.components.account-form-modal />
</div>

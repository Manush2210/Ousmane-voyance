<div class="mx-auto px-4 py-8 container">
    <div class="flex md:flex-row flex-col md:justify-between md:items-center mb-6">
        <h1 class="font-bold text-white text-2xl">Moyens de Paiement</h1>

        <div class="flex md:flex-row flex-col gap-3 mt-4 md:mt-0">
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="Rechercher..."
                    class="bg-gray-800 px-4 py-2 border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full md:w-64 text-white">
                <div class="right-0 absolute inset-y-0 flex items-center pr-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <button wire:click="$dispatch('openModal')"
                class="inline-flex items-center bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 px-4 py-2 border border-transparent focus:border-emerald-700 rounded-md focus:outline-none focus:ring focus:ring-emerald-200 font-semibold text-white text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ajouter un moyen de paiement
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-500 mb-4 p-4 rounded-md text-white">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-500 mb-4 p-4 rounded-md text-white">
            {{ session('error') }}
        </div>
    @endif

    <!-- Desktop View -->
    <div class="hidden md:block bg-gray-800 shadow rounded-lg overflow-hidden">
        <table class="divide-y divide-gray-700 min-w-full">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Logo</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @foreach ($paymentMethods as $method)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($method->logo)
                                <img src="{{ asset('storage/' . $method->logo) }}" alt="{{ $method->name }}"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <div class="flex justify-center items-center bg-gray-600 rounded-full w-10 h-10">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-white whitespace-nowrap">{{ $method->name }}</td>
                        <td class="px-6 py-4 text-white whitespace-nowrap">{{ $method->code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($method->is_active)
                                <span
                                    class="inline-flex bg-emerald-100 px-2 rounded-full font-semibold text-emerald-800 text-xs leading-5">
                                    Actif
                                </span>
                            @else
                                <span
                                    class="inline-flex bg-red-100 px-2 rounded-full font-semibold text-red-800 text-xs leading-5">
                                    Inactif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm whitespace-nowrap">
                            <button wire:click="$dispatch('openModal', { paymentMethodId: {{ $method->id }} })"
                                class="mr-3 text-blue-500 hover:text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button wire:click="deletePaymentMethod({{ $method->id }})"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce moyen de paiement ?')"
                                class="text-emerald-500 hover:text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile View -->
    <div class="md:hidden space-y-4 w-full">
        @foreach ($mobilePaymentMethods as $method)
            <div class="bg-gray-800 rounded-lg w-full overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center gap-3 mb-3">
                        @if ($method->logo)
                            <img src="{{ asset('storage/' . $method->logo) }}" alt="{{ $method->name }}"
                                class="rounded-lg w-12 h-12 object-cover">
                        @else
                            <div class="flex justify-center items-center bg-gray-600 rounded-lg w-12 h-12">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-medium text-white">{{ $method->name }}</h3>
                            <p class="text-gray-400 text-sm">Code: {{ $method->code }}</p>
                        </div>
                        <div class="text-right">
                            @if ($method->is_active)
                                <span
                                    class="inline-flex bg-emerald-100 px-2 rounded-full font-semibold text-emerald-800 text-xs leading-5">
                                    Actif
                                </span>
                            @else
                                <span
                                    class="inline-flex bg-red-100 px-2 rounded-full font-semibold text-red-800 text-xs leading-5">
                                    Inactif
                                </span>
                            @endif
                        </div>
                    </div>

                    @if ($method->description)
                        <p class="mb-4 text-gray-400 text-sm">{{ Str::limit($method->description, 100) }}</p>
                    @endif

                    <div class="flex justify-end gap-2">
                        <button wire:click="$dispatch('openModal', { paymentMethodId: {{ $method->id }} })"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md text-white text-sm">
                            Modifier
                        </button>
                        <button wire:click="deletePaymentMethod({{ $method->id }})"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce moyen de paiement ?')"
                            class="flex-1 bg-emerald-500 hover:bg-emerald-600 px-4 py-2 rounded-md text-white text-sm">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        @if (count($paymentMethods) > 3 && !$showAll)
            <div class="pt-4 text-center">
                <button wire:click="$set('showAll', true)"
                    class="font-semibold text-emerald-500 hover:text-emerald-600">
                    Voir plus
                </button>
            </div>
        @endif
    </div>

    <div class="mt-4">
        {{ $paymentMethods->links() }}
    </div>

    @livewire('admin.components.payment-method-form-modal')
</div>

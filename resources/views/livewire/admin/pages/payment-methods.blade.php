<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Moyens de Paiement</h1>

        <div class="mt-4 md:mt-0 flex flex-col md:flex-row gap-3">
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="Rechercher..."
                    class="w-full md:w-64 bg-gray-800 border border-gray-700 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <button wire:click="$dispatch('openModal')"
                class="inline-flex items-center px-4 py-2 bg-purple-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-600 active:bg-purple-700 focus:outline-none focus:border-purple-700 focus:ring focus:ring-purple-200 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ajouter un moyen de paiement
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-purple-500 text-white rounded-md">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-500 text-white rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <!-- Desktop View -->
    <div class="hidden md:block bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Logo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @foreach ($paymentMethods as $method)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($method->logo)
                                <img src="{{ asset('storage/' . $method->logo) }}" alt="{{ $method->name }}"
                                    class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">{{ $method->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">{{ $method->code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($method->is_active)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    Actif
                                </span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Inactif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            <button wire:click="$dispatch('openModal', { paymentMethodId: {{ $method->id }} })"
                                class="text-blue-500 hover:text-blue-700 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button wire:click="deletePaymentMethod({{ $method->id }})"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce moyen de paiement ?')"
                                class="text-purple-500 hover:text-purple-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
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
            <div class="bg-gray-800 w-full rounded-lg overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center gap-3 mb-3">
                        @if ($method->logo)
                            <img src="{{ asset('storage/' . $method->logo) }}" alt="{{ $method->name }}"
                                class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 bg-gray-600 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-medium text-white">{{ $method->name }}</h3>
                            <p class="text-sm text-gray-400">Code: {{ $method->code }}</p>
                        </div>
                        <div class="text-right">
                            @if ($method->is_active)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    Actif
                                </span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Inactif
                                </span>
                            @endif
                        </div>
                    </div>

                    @if ($method->description)
                        <p class="text-sm text-gray-400 mb-4">{{ Str::limit($method->description, 100) }}</p>
                    @endif

                    <div class="flex gap-2 justify-end">
                        <button wire:click="$dispatch('openModal', { paymentMethodId: {{ $method->id }} })"
                            class="flex-1 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 text-sm">
                            Modifier
                        </button>
                        <button wire:click="deletePaymentMethod({{ $method->id }})"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce moyen de paiement ?')"
                            class="flex-1 bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 text-sm">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        @if (count($paymentMethods) > 3 && !$showAll)
            <div class="text-center pt-4">
                <button wire:click="$set('showAll', true)"
                    class="text-purple-500 hover:text-purple-600 font-semibold">
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

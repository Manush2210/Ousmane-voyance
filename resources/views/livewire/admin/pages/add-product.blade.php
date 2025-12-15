<div class="flex-1 px-2 sm:px-0 overflow-hidden">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-extralight text-white/50 text-3xl">Produits</h3>

    </div>
    <div class="flex gap-4 my-4">
        <div class="relative">
            <input type="text" wire:model.live="search" placeholder="Rechercher un produit..."
                class="bg-gray-900 py-2 pr-4 pl-10 rounded-md w-64 text-white">
            <svg class="top-2.5 left-3 absolute w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <button wire:click="$dispatch('openModal')"
            class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Ajouter
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-300 mb-6 p-4 rounded-md text-white">
            {{ session('message') }}
        </div>
    @endif

    <!-- Vue Desktop -->
    <div class="hidden md:block bg-gray-800 shadow rounded-lg overflow-hidden">
        <table class="divide-y divide-gray-700 min-w-full">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 font-medium text-white text-xs text-left uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if (count($product->images) > 0)
                                <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <div class="flex justify-center items-center bg-gray-600 rounded-full w-10 h-10">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-white whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-white whitespace-nowrap">{{ number_format($product->price, 2) }} €
                        </td>
                        <td class="px-6 py-4 text-white whitespace-nowrap">{{ $product->stock }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->is_active)
                                <span
                                    class="inline-flex bg-emerald-100 px-2 rounded-full font-semibold text-emerald-800 text-xs leading-5">
                                    Actif
                                </span>
                            @else
                                <span
                                    class="inline-flex bg-emerald-100 px-2 rounded-full font-semibold text-emerald-800 text-xs leading-5">
                                    Inactif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-sm whitespace-nowrap">
                            <div class="flex gap-2">
                                <button wire:click="$dispatch('openModal', { productId: {{ $product->id }} })"
                                    class="text-blue-400 hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button wire:click="deleteProduct({{ $product->id }})"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                                    class="text-emerald-400 hover:text-emerald-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-gray-700 border-t">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Vue Mobile -->
    <div class="md:hidden space-y-3">
        @foreach ($mobileProducts as $product)
            <div class="shadow-sm rounded-lg overflow-hidden">
                <div class="bg-blue-500 h-2"></div>
                <div class="p-4">
                    <!-- Date et Statut -->
                    <div class="flex justify-between items-center mb-3 text-sm">
                        <span class="text-gray-500">{{ $product->created_at->format('d M Y') }}</span>
                        @if ($product->is_active)
                            <span class="bg-emerald-50 px-2 py-1 rounded-full font-medium text-emerald-700 text-xs">
                                Actif
                            </span>
                        @else
                            <span class="bg-emerald-50 px-2 py-1 rounded-full font-medium text-emerald-700 text-xs">
                                Inactif
                            </span>
                        @endif
                    </div>

                    <!-- Info Produit -->
                    <div class="flex items-center gap-3 mb-3">
                        @if (count($product->images) > 0)
                            <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}"
                                class="rounded-lg w-16 h-16 object-cover">
                        @else
                            <div class="flex justify-center items-center bg-gray-100 rounded-lg w-16 h-16">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $product->name }}</h3>
                            <p class="text-gray-500 text-sm">ID: #{{ $product->id }}</p>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-blue-600 text-lg">{{ number_format($product->price, 2) }} €
                            </div>
                            <div class="text-gray-500 text-sm">Stock: {{ $product->stock }}</div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end items-center gap-2 pt-3 border-gray-100 border-t">
                        <button wire:click="$dispatch('openModal', { productId: {{ $product->id }} })"
                            class="inline-flex items-center hover:bg-blue-50 px-3 py-1.5 border border-blue-600 rounded-md font-medium text-blue-600 text-sm">
                            <svg class="mr-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Modifier
                        </button>
                        <button wire:click="deleteProduct({{ $product->id }})"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                            class="inline-flex items-center hover:bg-emerald-50 px-3 py-1.5 border border-emerald-600 rounded-md font-medium text-emerald-600 text-sm">
                            <svg class="mr-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        @if (!$showAll && $products->count() > 3)
            <button wire:click="$set('showAll', true)"
                class="bg-gray-50 hover:bg-gray-100 py-3 border border-gray-200 rounded-lg w-full font-medium text-gray-700 text-sm transition">
                Voir plus de produits ({{ $products->count() - 3 }} restants)
            </button>
        @endif
    </div>

    <livewire:admin.components.product-form-modal />
</div>

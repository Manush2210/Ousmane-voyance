<div class="flex-1 px-2 sm:px-0">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-extralight text-white/50">Produits</h3>
    </div>

    <div class="flex gap-4 my-4">
        <div class="relative">
            <input type="text" wire:model.live="search" placeholder="Rechercher un produit..."
                class="bg-gray-900 text-white rounded-md pl-10 pr-4 py-2 w-64">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <button wire:click="$dispatch('openModal')"
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Ajouter
        </button>
    </div>

    <!-- Vue Desktop -->
    <div class="hidden md:block">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach ($products as $product)
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ Storage::url($product->images[0] ?? '') }}" alt="{{ $product->name }}"
                            class="w-full h-48 object-cover">
                    </div>
                    <div class="p-4">
                        <h4 class="text-white text-lg font-semibold mb-2">{{ $product->name }}</h4>
                        <p class="text-gray-400 text-sm mb-2">{{ Str::limit($product->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-white font-bold">{{ number_format($product->price, 2) }} €</span>
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
                                    class="text-red-400 hover:text-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Vue Mobile -->
    <div class="md:hidden space-y-4">
        @foreach ($mobileProducts as $product)
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <img src="{{ Storage::url($product->images[0] ?? '') }}" alt="{{ $product->name }}"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-white text-lg font-semibold mb-2">{{ $product->name }}</h4>
                    <p class="text-gray-400 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-white font-bold text-xl">{{ number_format($product->price, 2) }} €</span>
                        <span class="text-gray-400">Stock: {{ $product->stock }}</span>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button wire:click="$dispatch('openModal', { productId: {{ $product->id }} })"
                            class="flex-1 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Modifier
                        </button>
                        <button wire:click="deleteProduct({{ $product->id }})"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                            class="flex-1 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        @if (!$showAll && $products->count() > 3)
            <button wire:click="$set('showAll', true)"
                class="w-full bg-gray-700 text-white py-3 rounded-lg hover:bg-gray-600 transition">
                Voir plus de produits ({{ $products->count() - 3 }} restants)
            </button>
        @endif
    </div>

    <livewire:admin.components.product-form-modal />
</div>

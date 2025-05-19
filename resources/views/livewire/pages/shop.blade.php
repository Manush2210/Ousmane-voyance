<div>
    <section class="bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <!-- En-tête avec barre de recherche -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <h2 class="text-4xl text-gray-600 font-['Dancing_Script']">Boutique</h2>

                <div class="flex items-center gap-4 w-full md:w-auto">
                    <!-- Barre de recherche -->
                    <div class="relative flex-1 md:w-96">
                        <input type="text" wire:model.live="search" placeholder="Rechercher un produit..."
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-lime-500 focus:ring-1 focus:ring-lime-500 outline-none transition">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Boutons de vue -->
                    <div class="flex items-center gap-2">
                        <button wire:click="toggleViewMode"
                            class="p-2 rounded-lg hover:bg-gray-100 transition {{ $viewMode === 'grid' ? 'bg-gray-100' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>
                        <button wire:click="toggleViewMode"
                            class="p-2 rounded-lg hover:bg-gray-100 transition {{ $viewMode === 'list' ? 'bg-gray-100' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Grille de produits -->
            @if ($viewMode === 'grid')
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($products as $item)
                        @livewire(
                            'components.product.product-card',
                            [
                                'images' => $item->images,
                                'title' => $item->name,
                                'price' => $item->price,
                                'slug' => $item->slug,
                            ],
                            key($item->id)
                        )
                    @empty
                        <div class="col-span-full text-center py-8">
                            <h3 class="text-xl text-gray-600">Aucun produit trouvé</h3>
                            <p class="text-gray-500 mt-2">Nous n'avons pas trouvé de produits correspondant à votre
                                recherche.</p>
                        </div>
                    @endforelse
                </div>
            @else
                <!-- Vue liste -->
                <div class="flex flex-col gap-4">
                    @forelse ($products as $item)
                        @livewire(
                            'components.product.product-list-view',
                            [
                                'images' => $item->images,
                                'title' => $item->name,
                                'price' => $item->price,
                                'slug' => $item->slug,
                                'description' => $item->description,
                            ],
                            key($item->id)
                        )
                    @empty
                        <div class="text-center py-8">
                            <h3 class="text-xl text-gray-600">Aucun produit trouvé</h3>
                            <p class="text-gray-500 mt-2">Nous n'avons pas trouvé de produits correspondant à votre
                                recherche.</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </section>
</div>

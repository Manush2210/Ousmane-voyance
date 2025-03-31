<div>
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl mb-6 text-gray-600 text-left font-semibold font-['Dancing_Script']">Résultats de recherche</h2>

            <!-- Barre de recherche en haut des résultats -->
            <div class="mb-8 max-w-xl">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Affiner votre recherche..."
                        class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                    <button wire:click="$refresh" class="absolute right-3 top-3 text-gray-500 hover:text-red-600">
                        <x-heroicon-s-magnifying-glass class="h-5 w-5" />
                    </button>
                </div>
                <p class="text-gray-500 mt-2">
                    @if(strlen($search) >= 2)
                        {{ count($results) }} produit(s) trouvé(s) pour "{{ $search }}"
                    @else
                        Saisissez au moins 2 caractères pour lancer la recherche
                    @endif
                </p>
            </div>

            <!-- Résultats de recherche -->
            @if(strlen($search) >= 2)
                <div class="flex flex-col gap-4">
                    @forelse ($results as $item)
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
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-2xl text-gray-600 mb-2">Aucun produit trouvé</h3>
                            <p class="text-gray-500 max-w-md mx-auto mb-6">
                                Nous n'avons pas trouvé de produits correspondant à "{{ $search }}".
                                Essayez d'autres mots-clés ou consultez nos catégories populaires.
                            </p>
                            <a href="{{ route('shop') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-md transition">
                                Parcourir tous les produits
                            </a>
                        </div>
                    @endforelse
                </div>
            @elseif(empty($search))
                <!-- Afficher des produits populaires ou des catégories si aucune recherche n'est effectuée -->
                <div class="text-center py-8">
                    <h3 class="text-2xl text-gray-600 mb-4">Découvrez nos produits populaires</h3>
                    <a href="{{ route('shop') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-md transition">
                        Parcourir la boutique
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>

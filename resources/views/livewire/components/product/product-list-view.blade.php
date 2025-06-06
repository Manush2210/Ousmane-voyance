<div class="flex items-start space-x-2 sm:space-x-4 p-2 sm:p-4 border border-gray-200 rounded-lg">
    <!-- Image -->
    <div class="w-16 h-24 sm:w-24 sm:h-32 flex-shrink-0">
        <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $title }}"
            class="w-full h-full object-cover rounded-lg">
    </div>

    <!-- Informations produit -->
    <div class="flex-1">
        <h2 class="text-base sm:text-lg font-bold text-purple-700">
            <a href="{{ route('single-product', ['slug' => $slug]) }}" class="hover:underline">{{ $title }}</a>
        </h2>
        <p class="text-gray-700 text-sm sm:text-md font-semibold">{{ number_format($price, 2, ',', ' ') }} €</p>
        <p class="text-gray-600 text-xs sm:text-sm mt-1 sm:mt-2 line-clamp-2 sm:line-clamp-3">{{ $description }}</p>

        <!-- Lien voir détails -->
        <a href="{{ route('single-product', ['slug' => $slug]) }}"
            class="text-purple-500 text-xs sm:text-sm font-semibold mt-1 sm:mt-2 block underline">+ Voir les détails</a>

        <!-- Boutons -->
        <div class="mt-2 sm:mt-3 flex space-x-1 sm:space-x-2">
            <button wire:click="addToCart({{ $product->id }})"
                class="bg-purple-600 text-white px-2 sm:px-4 py-1 sm:py-2 rounded-lg text-xs sm:text-sm hover:bg-purple-300">
                Ajouter au panier
            </button>
            <button
                class="border border-purple-600 text-purple-600 px-2 sm:px-4 py-1 sm:py-2 rounded-lg text-xs sm:text-sm hover:bg-purple-100">
                ❤️
            </button>
        </div>

        <!-- Message de succès -->
        @if (session()->has('message'))
            <p class="text-purple-600 text-xs sm:text-sm mt-1 sm:mt-2">{{ session('message') }}</p>
        @endif
    </div>
</div>

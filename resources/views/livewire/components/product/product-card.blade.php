<div class="border border-gray-200 bg-white flex flex-col h-full p-2 sm:p-4">

    <div class="relative aspect-square">
        <img src="{{ asset('storage/' . $images[0]) ?? 'https://via.placeholder.com/300' }}" alt="{{ $title }}"
            class="w-full h-full object-cover rounded-lg">
    </div>

    <div class="mt-2 sm:mt-4 text-center flex-grow">
        <a href="{{ route('single-product', ['slug' => $slug]) }}">
            <h3 class="text-sm sm:text-base font-semibold text-gray-800 line-clamp-2">{{ $title }}</h3>
        </a>

        <p class="text-gray-400 text-base sm:text-lg font-semibold mt-1">{{ number_format($price, 2, ',', ' ') }} €</p>
    </div>

    <div class="mt-auto pt-2 sm:pt-4 flex justify-center items-center gap-2">
        <button wire:click="addToCart({{ $product->id }})"
            class="bg-purple-600 text-white text-sm sm:text-base px-3 py-1.5 sm:px-6 sm:py-3 rounded-lg hover:bg-purple-500 active:bg-purple-700 transition">
            Ajouter au panier
        </button>
        {{-- <button
            class="border border-purple-600 text-purple-600 px-2 py-1.5 sm:px-4 sm:py-3 rounded-lg hover:bg-purple-50 active:bg-purple-100 transition">
            ❤️
        </button> --}}
    </div>

</div>

<div class="border-2 border-gray-200 p-4 bg-white flex flex-col h-full">


        <div class="relative">
            <img src="{{ asset('storage/' . $images[0]) ?? 'https://via.placeholder.com/300' }}" alt="{{ $title }}"
                class="w-full h-56 object-cover rounded-lg">
        </div>

        <div class="mt-4 text-center flex-grow">
            <a href="{{ route('single-product', ['slug' => $slug]) }}">
                <h3 class="text-lg font-semibold text-gray-800 line-clamp-2">{{ $title }}</h3>
            </a>

            <p class="text-gray-400 text-lg font-semibold mt-1">{{ number_format($price, 2, ',', ' ') }} €</p>
        </div>

        <div class="mt-auto pt-4 flex justify-center items-baseline">
            <button wire:click="addToCart({{ $product->id }})"
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                Ajouter au panier
            </button>
            <button class="ml-2 border border-red-600 text-red-600 px-3 py-2 rounded-lg hover:bg-red-100 transition">
                ❤️
            </button>
        </div>

</div>

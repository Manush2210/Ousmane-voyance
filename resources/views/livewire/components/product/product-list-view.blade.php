<div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-lg">
    <!-- Image -->
    <div class="w-24 h-32 flex-shrink-0">
        <img src="{{ asset('storage/'. $images[0]) }}" alt="{{ $title}}" class="w-full h-full object-cover rounded-lg">
    </div>

    <!-- Informations produit -->
    <div class="flex-1">
        <h2 class="text-lg font-bold text-red-700">
            <a href="{{route('single-product',['slug'=>$slug])}}" class="hover:underline">{{ $title}}</a>
        </h2>
        <p class="text-gray-700 text-md font-semibold">{{ number_format($price, 2, ',', ' ') }} €</p>
        <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ $description }}</p>

        <!-- Lien voir détails -->
        <a href="{{route('single-product',['slug'=>$slug])}}" class="text-red-500 text-sm font-semibold mt-2 block underline">+ Voir les détails</a>

        <!-- Boutons -->
        <div class="mt-3 flex space-x-2">
            <button  wire:click="addToCart({{ $product->id }})" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">
                Ajouter au panier
            </button>
            <button class="border border-red-600 text-red-600 px-4 py-2 rounded-lg text-sm hover:bg-red-100">
                ❤️
            </button>
        </div>

        <!-- Message de succès -->
        @if (session()->has('message'))
            <p class="text-green-600 text-sm mt-2">{{ session('message') }}</p>
        @endif
    </div>
</div>

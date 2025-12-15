<div class="mx-auto p-6 max-w-6xl">
    <div class="gap-8 grid grid-cols-1 md:grid-cols-2">
        <!-- Section Images -->
        <div>
            <div class="relative">
                <img src="{{ asset('storage/' . $product['images'][0]) ?? 'https://via.placeholder.com/400' }}"
                    alt="{{ $product['title'] }}" class="rounded-lg w-full h-96 object-cover" id="mainImage">
            </div>

            <!-- Miniatures -->
            <div class="flex space-x-2 mt-4">
                @foreach ($product['images'] as $index => $image)
                    <img src="{{ asset('storage/' . $image) }}"
                        class="cursor-pointer w-16 h-16 object-cover rounded-lg border hover:border-emerald-500 {{ $index === 0 ? 'border-emerald-500' : '' }}"
                        onclick="document.getElementById('mainImage').src = this.src;
                      document.querySelectorAll('.flex.space-x-2.mt-4 img').forEach(img => img.classList.remove('border-emerald-500'));
                      this.classList.add('border-emerald-500');">
                @endforeach
            </div>
        </div>

        <!-- Détails Produit -->
        <div>
            <h1 class="font-bold text-gray-800 text-3xl">{{ $product['name'] }}</h1>
            <p class="mt-2 font-semibold text-gray-600 text-xl">{{ number_format($product['price'], 2, ',', ' ') }} €
            </p>

            {{--  five Rating gold star --}}
            <div class="rating">
                <span class="text-yellow-500">
                    @for ($i = 0; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="currentColor"
                            viewBox="0 0 24 24" stroke="none">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    @endfor
                </span>

            </div>


            <!-- Boutons -->
            <div class="flex items-center space-x-4 mt-6">
                <div class="flex items-center">
                    <input type="number" value="1" wire:model.live='quantity'
                        class="bg-gray-200 border-gray-300 w-10 h-10 text-center [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none qty-selector [appearance:textfield]">
                    <div class="flex flex-col space-y-3 ml-1">
                        <button wire:click="increment"
                            class="bg-gray-300 hover:bg-gray-400 px-1 rounded-t text-gray-800 text-xs cursor-pointer"
                            wire:click="$set('quantity', $event.target.previousElementSibling?.value ? parseInt($event.target.previousElementSibling.value) + 1 : 2)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m6-3H6" />
                            </svg>
                        </button>
                        <button wire:click="decrement"
                            class="bg-gray-300 hover:bg-gray-400 px-1 rounded-b text-gray-800 text-xs cursor-pointer"
                            wire:click="$set('quantity', $event.target.previousElementSibling?.previousElementSibling?.previousElementSibling?.value > 1 ? parseInt($event.target.previousElementSibling.previousElementSibling.previousElementSibling.value) - 1 : 1)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button wire:click="addToCart({{ $product['id'] }})"
                    class="bg-emerald-600 hover:bg-emerald-300 px-6 py-3 rounded-lg text-white transition">
                    Ajouter au panier
                </button>
                <button
                    class="hover:bg-emerald-100 px-6 py-3 border border-emerald-600 rounded-lg text-emerald-600 transition">
                    ❤️
                </button>
            </div>
            <div class="mt-6">
                <hr class="block mx-auto py-4 h-3 text-gray-300 text-center">
            </div>


            <p class="mt-4 text-gray-600">{{ $product['description'] }}</p>

            @if (session()->has('message'))
                <p class="mt-4 text-emerald-600">{{ session('message') }}</p>
            @endif
        </div>
    </div>
</div>

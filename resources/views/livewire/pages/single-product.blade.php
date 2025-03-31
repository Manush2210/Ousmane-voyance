<div class="max-w-6xl mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Section Images -->
        <div>
            <div class="relative">
            <img src="{{asset('storage/'.$product['images'][0])  ?? 'https://via.placeholder.com/400' }}" alt="{{ $product['title'] }}"
                class="w-full h-96 object-cover rounded-lg" id="mainImage">
            </div>

            <!-- Miniatures -->
            <div class="flex space-x-2 mt-4">
            @foreach($product['images'] as $index => $image)
                <img src="{{ asset('storage/'.$image ) }}"
                 class="cursor-pointer w-16 h-16 object-cover rounded-lg border hover:border-red-500 {{ $index === 0 ? 'border-red-500' : '' }}"
                 onclick="document.getElementById('mainImage').src = this.src;
                      document.querySelectorAll('.flex.space-x-2.mt-4 img').forEach(img => img.classList.remove('border-red-500'));
                      this.classList.add('border-red-500');">
            @endforeach
            </div>
        </div>

        <!-- Détails Produit -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $product['name'] }}</h1>
            <p class="text-xl text-gray-600 mt-2 font-semibold">{{ number_format($product['price'], 2, ',', ' ') }} €</p>

            {{--  five Rating gold star --}}
            <div class="rating">
                <span class="text-yellow-500 ">
                    @for ($i = 0; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    @endfor
                </span>

            </div>


            <!-- Boutons -->
            <div class="mt-6 flex space-x-4 items-center">
                <div class="flex items-center">
                    <input type="number" value="1" wire:model.live='quantity' class="qty-selector border-gray-300 bg-gray-200 w-10 h-10 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                    <div class="flex flex-col ml-1 space-y-3">
                        <button wire:click="increment" class="bg-gray-300 cursor-pointer hover:bg-gray-400 text-gray-800 px-1 text-xs rounded-t" wire:click="$set('quantity', $event.target.previousElementSibling?.value ? parseInt($event.target.previousElementSibling.value) + 1 : 2)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m6-3H6" />
                            </svg>
                        </button>
                        <button wire:click="decrement" class="bg-gray-300 cursor-pointer hover:bg-gray-400 text-gray-800 px-1 text-xs rounded-b" wire:click="$set('quantity', $event.target.previousElementSibling?.previousElementSibling?.previousElementSibling?.value > 1 ? parseInt($event.target.previousElementSibling.previousElementSibling.previousElementSibling.value) - 1 : 1)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button wire:click="addToCart({{ $product['id'] }})" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition">
                    Ajouter au panier
                </button>
                <button class="border border-red-600 text-red-600 px-6 py-3 rounded-lg hover:bg-red-100 transition">
                    ❤️
                </button>
            </div>
            <div class="mt-6">
                <hr class="text-gray-300 h-3 block mx-auto text-center py-4" >
            </div>


            <p class="text-gray-600 mt-4">{{ $product['description'] }}</p>

            @if (session()->has('message'))
                <p class="mt-4 text-green-600">{{ session('message') }}</p>
            @endif
        </div>
    </div>
</div>

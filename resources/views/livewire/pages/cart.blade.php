<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Panier</h1>

    <div class="border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
        @if (empty($cartItems))
            <div class="text-center py-8">
                <p class="text-gray-500 mb-4">Votre panier est vide</p>
                <a href="{{ route('shop') }}" class="text-purple-600 hover:underline">Poursuivre les achats</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b flex-row gap-4 items-baseline">
                            <th class="text-left py-2">Produit</th>
                            <th class="text-center py-2">Quantité</th>
                            <th class="text-left py-2 ">Prix unitaire</th>
                            <th class="text-right py-2">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $productId => $item)
                            <tr class="border-b hover:bg-gray-50 flex-row gap-4 items-baseline">
                                <td class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                            alt="{{ $item['product']['name'] }}"
                                            class="w-16 h-16 rounded-lg object-cover">
                                        <a href="{{ route('single-product', ['slug' => $item['product']['slug'] ?? $productId]) }}"
                                            class="text-purple-600 font-semibold hover:underline">
                                            {{ $item['product']['name'] }}
                                        </a>
                                    </div>
                                </td>
                                <td class="py-4 text-center ">
                                    <select wire:model="cartItems.{{ $productId }}.quantity"
                                        wire:change="updateQuantity({{ $productId }}, $event.target.value)"
                                        class="border-gray-300 rounded-md p-2 min-w-[50px] md:min-w-[80px]">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td class="py-4 text-left text-sm">
                                    {{ number_format($item['product']['price'], 2, ',', ' ') }} €
                                </td>
                                <td class="py-4 text-right font-semibold text-sm text-nowrap">
                                    {{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }} €
                                </td>
                                <td class="py-4 text-right">
                                    <button wire:click="removeItem({{ $productId }})"
                                        class="text-gray-500 hover:text-purple-500 p-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Calculs du total -->
            <div class="mt-6 text-right text-gray-700 space-y-2">
                <p>Sous-total : <span class="font-semibold">{{ number_format($subtotal, 2, ',', ' ') }} €</span></p>
                <p>Frais de port : <span class="font-semibold">{{ number_format($shipping, 2, ',', ' ') }} €</span></p>
                <p class="text-purple-500 font-semibold">Livraison gratuite à partir de
                    {{ number_format($free_shipping_threshold, 2, ',', ' ') }} €</p>

                <p class="text-xl font-bold mt-4">Montant total :
                    <span class="text-gray-900">{{ number_format($total, 2, ',', ' ') }} €</span>
                </p>
            </div>

            <!-- Boutons -->
            <div class="mt-6 flex flex-wrap justify-between items-center gap-4">
                <div class="flex space-x-4">
                    <a href="{{ route('shop') }}" class="text-purple-600 hover:underline">
                        « Poursuivre les achats
                    </a>
                    <button wire:click="clearCart" class="text-gray-500 hover:text-purple-500">
                        Vider le panier
                    </button>
                </div>
                <a href="{{ route('order') }}"
                    class="bg-purple-600 text-white px-6 py-2 rounded-lg text-lg hover:bg-purple-300">
                    Commander
                </a>
            </div>
        @endif
    </div>

    <!-- Icônes de paiement -->
    <div class="flex space-x-4 mt-8 justify-center">
        <img src="{{ asset('assets/images/payment/visa.png') }}" alt="Visa" class="h-8">
        <img src="{{ asset('assets/images/payment/mastercard.png') }}" alt="Mastercard" class="h-8">
        <img src="{{ asset('assets/images/payment/amex.png') }}" alt="American Express" class="h-8">
        <img src="{{ asset('assets/images/payment/paypal.png') }}" alt="PayPal" class="h-8">
    </div>
</div>

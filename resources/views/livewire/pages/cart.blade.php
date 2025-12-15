<div class="mx-auto p-6 max-w-4xl">
    <h1 class="mb-6 font-bold text-2xl">Panier</h1>

    <div class="bg-white shadow-sm p-4 border border-gray-200 rounded-lg">
        @if (empty($cartItems))
            <div class="py-8 text-center">
                <p class="mb-4 text-gray-500">Votre panier est vide</p>
                <a href="{{ route('shop') }}" class="text-emerald-600 hover:underline">Poursuivre les achats</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="flex-row items-baseline gap-4 border-b">
                            <th class="py-2 text-left">Produit</th>
                            <th class="py-2 text-center">Quantité</th>
                            <th class="py-2 text-left">Prix unitaire</th>
                            <th class="py-2 text-right">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $productId => $item)
                            <tr class="flex-row items-baseline gap-4 hover:bg-gray-50 border-b">
                                <td class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                            alt="{{ $item['product']['name'] }}"
                                            class="rounded-lg w-16 h-16 object-cover">
                                        <a href="{{ route('single-product', ['slug' => $item['product']['slug'] ?? $productId]) }}"
                                            class="font-semibold text-emerald-600 hover:underline">
                                            {{ $item['product']['name'] }}
                                        </a>
                                    </div>
                                </td>
                                <td class="py-4 text-center">
                                    <select wire:model="cartItems.{{ $productId }}.quantity"
                                        wire:change="updateQuantity({{ $productId }}, $event.target.value)"
                                        class="p-2 border-gray-300 rounded-md min-w-[50px] md:min-w-[80px]">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td class="py-4 text-sm text-left">
                                    {{ number_format($item['product']['price'], 2, ',', ' ') }} €
                                </td>
                                <td class="py-4 font-semibold text-sm text-right text-nowrap">
                                    {{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }} €
                                </td>
                                <td class="py-4 text-right">
                                    <button wire:click="removeItem({{ $productId }})"
                                        class="p-1 text-gray-500 hover:text-emerald-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Calculs du total -->
            <div class="space-y-2 mt-6 text-gray-700 text-right">
                <p>Sous-total : <span class="font-semibold">{{ number_format($subtotal, 2, ',', ' ') }} €</span></p>
                <p>Frais de port : <span class="font-semibold">{{ number_format($shipping, 2, ',', ' ') }} €</span></p>
                <p class="font-semibold text-emerald-500">Livraison gratuite à partir de
                    {{ number_format($free_shipping_threshold, 2, ',', ' ') }} €</p>

                <p class="mt-4 font-bold text-xl">Montant total :
                    <span class="text-gray-900">{{ number_format($total, 2, ',', ' ') }} €</span>
                </p>
            </div>

            <!-- Boutons -->
            <div class="flex flex-wrap justify-between items-center gap-4 mt-6">
                <div class="flex space-x-4">
                    <a href="{{ route('shop') }}" class="text-emerald-600 hover:underline">
                        « Poursuivre les achats
                    </a>
                    <button wire:click="clearCart" class="text-gray-500 hover:text-emerald-500">
                        Vider le panier
                    </button>
                </div>
                <a href="{{ route('order') }}"
                    class="bg-emerald-600 hover:bg-emerald-300 px-6 py-2 rounded-lg text-white text-lg">
                    Commander
                </a>
            </div>
        @endif
    </div>

    <!-- Icônes de paiement -->
    <div class="flex justify-center space-x-4 mt-8">
        <img src="{{ asset('assets/images/payment/visa.png') }}" alt="Visa" class="h-8">
        <img src="{{ asset('assets/images/payment/mastercard.png') }}" alt="Mastercard" class="h-8">
        <img src="{{ asset('assets/images/payment/amex.png') }}" alt="American Express" class="h-8">
        <img src="{{ asset('assets/images/payment/paypal.png') }}" alt="PayPal" class="h-8">
    </div>
</div>

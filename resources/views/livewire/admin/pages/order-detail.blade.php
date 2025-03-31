<div class="flex-1 px-2 sm:px-0">
    <!-- En-tête avec statut -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h3 class="text-3xl font-extralight text-white/50">
            Commande #{{ $order->order_number }}
        </h3>
        <div class="flex items-center gap-4 w-full md:w-auto">
            <span class="text-white whitespace-nowrap">Statut:</span>
            <select wire:change="updateStatus($event.target.value)"
                    class="bg-gray-900 text-white rounded-md px-4 py-2 w-full md:w-auto">
                <option value="pending" @selected($order->status === 'pending')>En attente</option>
                <option value="processing" @selected($order->status === 'processing')>En cours</option>
                <option value="completed" @selected($order->status === 'completed')>Terminée</option>
                <option value="cancelled" @selected($order->status === 'cancelled')>Annulée</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Informations Client -->
        <div class="bg-gray-800 rounded-lg p-6">
            <h4 class="text-xl text-white mb-4">Informations Client</h4>
            <div class="space-y-3">
                <div>
                    <span class="text-gray-400">Nom:</span>
                    <span class="text-white">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Email:</span>
                    <span class="text-white">{{ $order->shipping_email }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Téléphone:</span>
                    <span class="text-white">{{ $order->shipping_phone }}</span>
                </div>
            </div>
        </div>

        <!-- Adresse de Livraison -->
        <div class="bg-gray-800 rounded-lg p-6">
            <h4 class="text-xl text-white mb-4">Adresse de Livraison</h4>
            <div class="space-y-3">
                <div class="text-white">{{ $order->shipping_address }}</div>
                <div class="text-white">
                    {{ $order->shipping_postal_code }} {{ $order->shipping_city }}
                </div>
                <div class="text-white">{{ $order->shipping_country }}</div>
            </div>
        </div>

        <!-- Détails de la Commande - Vue Desktop -->
        <div class="hidden md:block bg-gray-800 rounded-lg p-6 md:col-span-2">
            <h4 class="text-xl text-white mb-4">Détails de la Commande</h4>
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Produit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Prix unitaire</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $item->product_name }}</td>
                            <td class="px-6 py-4 text-white">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-white">{{ number_format($item->price, 2) }} €</td>
                            <td class="px-6 py-4 text-white">{{ number_format($item->price * $item->quantity, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t border-gray-700">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right text-white">Sous-total:</td>
                        <td class="px-6 py-4 text-white">{{ number_format($order->subtotal, 2) }} €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right text-white">Frais de livraison:</td>
                        <td class="px-6 py-4 text-white">{{ number_format($order->shipping, 2) }} €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-bold text-white">Total:</td>
                        <td class="px-6 py-4 font-bold text-white">{{ number_format($order->total, 2) }} €</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Détails de la Commande - Vue Mobile -->
        <div class="md:hidden bg-gray-800 rounded-lg p-6 space-y-4">
            <h4 class="text-xl text-white mb-4">Détails de la Commande</h4>
            @foreach($order->items as $item)
                <div class="border-b border-gray-700 pb-4">
                    <div class="flex justify-between items-start mb-2">
                        <div class="text-white font-medium">{{ $item->product_name }}</div>
                        <div class="text-white">{{ number_format($item->price * $item->quantity, 2) }} €</div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-400">
                        <div>{{ $item->quantity }} x {{ number_format($item->price, 2) }} €</div>
                    </div>
                </div>
            @endforeach
            <div class="space-y-2 pt-4">
                <div class="flex justify-between text-white">
                    <span>Sous-total:</span>
                    <span>{{ number_format($order->subtotal, 2) }} €</span>
                </div>
                <div class="flex justify-between text-white">
                    <span>Frais de livraison:</span>
                    <span>{{ number_format($order->shipping, 2) }} €</span>
                </div>
                <div class="flex justify-between text-white font-bold pt-2 border-t border-gray-700">
                    <span>Total:</span>
                    <span>{{ number_format($order->total, 2) }} €</span>
                </div>
            </div>
        </div>

        <!-- Paiement -->
        <div class="bg-gray-800 rounded-lg p-6 md:col-span-2">
            <h4 class="text-xl text-white mb-4">Informations de Paiement</h4>
            <div class="space-y-3">
                <div>
                    <span class="text-gray-400">Méthode:</span>
                    <span class="text-white capitalize">{{ $order->payment_method }}</span>
                </div>
                @if($order->payment_proof)
                    <div>
                        <span class="text-gray-400">Justificatif:</span>
                        <a href="{{ Storage::url($order->payment_proof) }}"
                           target="_blank"
                           class="text-blue-400 hover:text-blue-300">
                            Voir le justificatif
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

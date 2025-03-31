<div class="flex-1 px-2 sm:px-0">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h3 class="text-3xl font-extralight text-white/50">Commandes</h3>
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <input type="text" wire:model.live="search" placeholder="Rechercher une commande..."
                class="bg-gray-900 text-white rounded-md px-4 py-2 w-full md:w-64">
            <select wire:model.live="status" class="bg-gray-900 text-white rounded-md px-4 py-2 w-full md:w-auto">
                <option value="">Tous les statuts</option>
                <option value="pending">En attente</option>
                <option value="processing">En cours</option>
                <option value="completed">Terminée</option>
                <option value="cancelled">Annulée</option>
            </select>
        </div>
    </div>

    <!-- Vue Desktop -->
    <div class="hidden md:block bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        N° Commande
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Client
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{ $order->order_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                            <span class="text-gray-400 text-sm">{{ $order->shipping_email }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{ number_format($order->total, 2) }} €
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select wire:change="setOrderStatus({{ $order->id }}, $event.target.value)"
                                    class="bg-gray-900 text-white rounded-md px-2 py-1 text-sm">
                                <option value="pending" @selected($order->status === 'pending')>En attente</option>
                                <option value="processing" @selected($order->status === 'processing')>En cours</option>
                                <option value="completed" @selected($order->status === 'completed')>Terminée</option>
                                <option value="cancelled" @selected($order->status === 'cancelled')>Annulée</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.orders.detail', $order) }}"
                               class="text-blue-400 hover:text-blue-600">
                                Détails
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Vue Mobile -->
    <div class="md:hidden space-y-4">
        @foreach($orders as $order)
            <div class="bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 space-y-4">
                    <!-- En-tête avec numéro de commande et statut -->
                    <div class="flex justify-between items-start">
                        <div class="space-y-1">
                            <p class="text-sm text-gray-400">Commande</p>
                            <p class="text-white font-medium">{{ $order->order_number }}</p>
                        </div>
                        <select wire:change="setOrderStatus({{ $order->id }}, $event.target.value)"
                                class="bg-gray-900 text-white rounded-md px-2 py-1 text-sm">
                            <option value="pending" @selected($order->status === 'pending')>En attente</option>
                            <option value="processing" @selected($order->status === 'processing')>En cours</option>
                            <option value="completed" @selected($order->status === 'completed')>Terminée</option>
                            <option value="cancelled" @selected($order->status === 'cancelled')>Annulée</option>
                        </select>
                    </div>

                    <!-- Informations client -->
                    <div class="space-y-1">
                        <p class="text-sm text-gray-400">Client</p>
                        <p class="text-white">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
                        <p class="text-sm text-gray-400">{{ $order->shipping_email }}</p>
                    </div>

                    <!-- Date et montant -->
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-400">Date</p>
                            <p class="text-white">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-400">Total</p>
                            <p class="text-white font-medium">{{ number_format($order->total, 2) }} €</p>
                        </div>
                    </div>

                    <!-- Bouton détails -->
                    <div class="pt-3 border-t border-gray-700">
                        <a href="{{ route('admin.orders.detail', $order) }}"
                           class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>

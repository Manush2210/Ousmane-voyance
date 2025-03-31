<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Navigation Tabs -->
        <div class="flex border-b mb-6">
            <a href="{{ route('profile') }}"
               class="px-6 py-2 font-medium {{ request()->routeIs('profile') ? 'text-red-600 border-b-2 border-red-600' : 'text-gray-500 hover:text-red-600' }}">
                Mon Profil
            </a>
            <a href="{{ route('order-history') }}"
               class="px-6 py-2 font-medium {{ request()->routeIs('order-history') ? 'text-red-600 border-b-2 border-red-600' : 'text-gray-500 hover:text-red-600' }}">
                Historique des commandes
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-6">Mes commandes</h2>

            @if($orders->isEmpty())
                <div class="text-center py-8">
                    <div class="text-gray-500 mb-4">Vous n'avez pas encore passé de commande</div>
                    <a href="{{ route('shop') }}" class="text-red-600 hover:text-red-700">
                        Découvrir nos produits
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    N° Commande
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $order->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($order->status === 'completed')
                                                bg-green-100 text-green-800
                                            @elseif($order->status === 'pending')
                                                bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'cancelled')
                                                bg-red-100 text-red-800
                                            @else
                                                bg-gray-100 text-gray-800
                                            @endif">
                                            @switch($order->status)
                                                @case('pending')
                                                    En attente
                                                    @break
                                                @case('processing')
                                                    En traitement
                                                    @break
                                                @case('completed')
                                                    Terminée
                                                    @break
                                                @case('cancelled')
                                                    Annulée
                                                    @break
                                                @default
                                                    {{ $order->status }}
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        {{ number_format($order->total, 2, ',', ' ') }}€
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="mx-auto px-4 py-8 container">
    <div class="mx-auto max-w-4xl">
        <!-- Navigation Tabs -->
        <div class="flex mb-6 border-b">
            <a href="{{ route('profile') }}"
                class="px-6 py-2 font-medium {{ request()->routeIs('profile') ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-500 hover:text-emerald-600' }}">
                Mon Profil
            </a>
            <a href="{{ route('order-history') }}"
                class="px-6 py-2 font-medium {{ request()->routeIs('order-history') ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-500 hover:text-emerald-600' }}">
                Historique des commandes
            </a>
        </div>

        <div class="bg-white shadow-sm p-6 rounded-lg">
            <h2 class="mb-6 font-semibold text-2xl">Mes commandes</h2>
            {{-- Sucess Message if session has new-order --}}
            @if (session('new-order'))
                <div class="relative bg-emerald-100 mb-4 px-4 py-3 border border-emerald-400 rounded text-emerald-700"
                    role="alert">
                    <strong class="font-bold">Commande passée avec succès !</strong>
                    <span class="block sm:inline">{{ session('new-order') }}</span>
                </div>
            @endif

            @if ($orders->isEmpty())
                <div class="py-8 text-center">
                    <div class="mb-4 text-gray-500">Vous n'avez pas encore passé de commande</div>
                    <a href="{{ route('shop') }}" class="text-emerald-600 hover:text-emerald-700">
                        Découvrir nos produits
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="divide-y divide-gray-200 min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                                    N° Commande
                                </th>
                                <th
                                    class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                                    Statut
                                </th>
                                <th
                                    class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $order->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if ($order->status === 'completed') bg-emerald-100 text-emerald-800
                                        @elseif($order->status === 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'cancelled')
                                            bg-emerald-100 text-emerald-800
                                        @else
                                            bg-gray-100 text-gray-800 @endif">
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
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
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

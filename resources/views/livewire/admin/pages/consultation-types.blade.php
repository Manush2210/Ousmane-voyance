<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="bg-gray-900 shadow-xl sm:rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-white text-2xl">Types de consultation</h2>
                    <button wire:click="$dispatch('openModal')"
                        class="inline-flex items-center bg-teal-600 hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 font-semibold text-white text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                        Nouveau type de consultation
                    </button>
                </div>

                <div class="mb-4">
                    <div class="relative">
                        <input type="text" wire:model.live="search"
                            placeholder="Rechercher un type de consultation..."
                            class="bg-gray-800 py-2 pr-4 pl-10 border border-gray-700 focus:border-teal-500 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 w-full text-white">
                        <div class="left-0 absolute inset-y-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Vue mobile -->
                <div class="sm:hidden block space-y-4">
                    @forelse($consultationTypes as $type)
                        <div class="bg-gray-800 p-4 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium text-white text-lg">{{ $type->name }}</h3>
                                    <p class="mt-1 text-teal-400">{{ number_format($type->price, 2) }} €</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button
                                        wire:click="$dispatch('openModal', { consultationTypeId: {{ $type->id }} })"
                                        class="text-teal-400 hover:text-teal-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                    <button wire:click="deleteConsultationType({{ $type->id }})"
                                        class="text-red-400 hover:text-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-4 text-gray-400 text-center">
                            Aucun type de consultation trouvé
                        </div>
                    @endforelse
                </div>

                <!-- Vue desktop -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="divide-y divide-gray-700 min-w-full">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 font-medium text-gray-300 text-xs text-left uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 font-medium text-gray-300 text-xs text-left uppercase tracking-wider">
                                    Prix
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 font-medium text-gray-300 text-xs text-right uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-700">
                            @forelse($consultationTypes as $type)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-white text-sm">{{ $type->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-white text-sm">{{ number_format($type->price, 2) }} €</div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-sm text-right whitespace-nowrap">
                                        <button
                                            wire:click="$dispatch('openModal', { consultationTypeId: {{ $type->id }} })"
                                            class="mr-3 text-teal-400 hover:text-teal-300">
                                            Modifier
                                        </button>
                                        <button wire:click="deleteConsultationType({{ $type->id }})"
                                            class="text-red-400 hover:text-red-300">
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="px-6 py-4 text-gray-400 text-sm text-center whitespace-nowrap">
                                        Aucun type de consultation trouvé
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $consultationTypes->links() }}
                </div>
            </div>
        </div>
    </div>

    <livewire:admin.components.consultation-type-form-modal />
</div>

<div class="flex-1 px-2 sm:px-0">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h3 class="text-3xl font-extralight text-white/50">Utilisateurs</h3>
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <input type="text" wire:model.live="search" placeholder="Rechercher un utilisateur..."
                class="bg-gray-900 text-white rounded-md px-4 py-2 w-full md:w-64">
            <select wire:model.live="role" class="bg-gray-900 text-white rounded-md px-4 py-2 w-full md:w-auto">
                <option value="">Tous les rôles</option>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>
        </div>
    </div>

    <!-- Vue Desktop -->
    <div class="hidden md:block bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Nom
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Type Client
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Date d'inscription
                    </th>
                    {{-- <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Rôle
                    </th> --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white capitalize">
                            {{ $user->client_type }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                            <select wire:change="updateRole({{ $user->id }}, $event.target.value)"
                                    class="bg-gray-900 text-white rounded-md px-2 py-1 text-sm">
                                <option value="user" @selected($user->role === 'user')>Utilisateur</option>
                                <option value="admin" @selected($user->role === 'admin')>Administrateur</option>
                            </select>
                        </td> --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.orders') }}?search={{ $user->email }}"
                               class="text-blue-400 hover:text-blue-600 mr-3">
                                Voir ses commandes
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Vue Mobile -->
    <div class="md:hidden space-y-4">
        @foreach($users as $user)
            <div class="bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 space-y-4">
                    <!-- En-tête avec nom et rôle -->
                    <div class="flex justify-between items-start">
                        <div class="space-y-1">
                            <h4 class="text-white font-medium">{{ $user->first_name }} {{ $user->last_name }}</h4>
                            <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        </div>
                        {{-- <select wire:change="updateRole({{ $user->id }}, $event.target.value)"
                                class="bg-gray-900 text-white rounded-md px-2 py-1 text-sm">
                            <option value="user" @selected($user->role === 'user')>Utilisateur</option>
                            <option value="admin" @selected($user->role === 'admin')>Administrateur</option>
                        </select> --}}
                    </div>

                    <!-- Informations supplémentaires -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-400">Type Client</p>
                            <p class="text-white capitalize">{{ $user->client_type }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Inscription</p>
                            <p class="text-white">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-3 border-t border-gray-700">
                        <a href="{{ route('admin.orders') }}?search={{ $user->email }}"
                           class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                            Voir ses commandes
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

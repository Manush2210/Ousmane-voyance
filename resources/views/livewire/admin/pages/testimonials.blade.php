<div class="flex-1 px-2 sm:px-0">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-extralight text-white/50 text-3xl">Témoignages</h3>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 mb-4 p-4 rounded-md text-white">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex gap-4 my-4">
        <div class="relative">
            <input type="text" wire:model.live="search" placeholder="Rechercher un témoignage..."
                class="bg-gray-900 py-2 pr-4 pl-10 rounded-md w-64 text-white">
            <svg class="top-2.5 left-3 absolute w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <button wire:click="openModal"
            class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Ajouter un témoignage
        </button>
    </div>

    <!-- Vue Desktop -->
    <div class="hidden md:block">
        <div class="gap-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($testimonials as $testimonial)
                <div class="bg-gray-800 rounded-lg p-4 {{ !$testimonial->is_active ? 'opacity-50' : '' }}">
                    <div class="flex items-center gap-3 mb-3">
                        @if ($testimonial->photo)
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}"
                                class="rounded-full w-12 h-12 object-cover">
                        @else
                            <div class="flex justify-center items-center bg-teal-500 rounded-full w-12 h-12">
                                <span class="font-bold text-white text-xl">{{ $testimonial->initial }}</span>
                            </div>
                        @endif
                        <div>
                            <h4 class="font-semibold text-white">{{ $testimonial->name }}</h4>
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimonial->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>

                    <p class="mb-3 text-gray-300 text-sm">{{ Str::limit($testimonial->message, 150) }}</p>

                    <div class="flex justify-between items-center mb-3 text-gray-400 text-xs">
                        <span title="{{ $testimonial->created_at->format('d/m/Y à H:i') }}">{{ $testimonial->formatted_date }}</span>
                        <span class="px-2 py-1 rounded {{ $testimonial->is_active ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                            {{ $testimonial->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button wire:click="toggleStatus({{ $testimonial->id }})"
                            class="text-yellow-400 hover:text-yellow-600" title="Activer/Désactiver">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button wire:click="edit({{ $testimonial->id }})"
                            class="text-blue-400 hover:text-blue-600" title="Modifier">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button wire:click="delete({{ $testimonial->id }})"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce témoignage ?')"
                            class="text-red-400 hover:text-red-600" title="Supprimer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-gray-400 text-center">
                    <svg class="mx-auto mb-4 w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p>Aucun témoignage trouvé</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $testimonials->links() }}
        </div>
    </div>

    <!-- Vue Mobile -->
    <div class="md:hidden space-y-4">
        @forelse ($testimonials as $testimonial)
            <div class="bg-gray-800 rounded-lg p-4 {{ !$testimonial->is_active ? 'opacity-50' : '' }}">
                <div class="flex items-center gap-3 mb-3">
                    @if ($testimonial->photo)
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}"
                            class="rounded-full w-10 h-10 object-cover">
                    @else
                        <div class="flex justify-center items-center bg-teal-500 rounded-full w-10 h-10">
                            <span class="font-bold text-white">{{ $testimonial->initial }}</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <h4 class="font-semibold text-white text-sm">{{ $testimonial->name }}</h4>
                        <div class="flex text-yellow-400 text-sm">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $testimonial->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded text-xs {{ $testimonial->is_active ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                        {{ $testimonial->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                </div>

                <p class="mb-3 text-gray-300 text-sm">{{ $testimonial->message }}</p>

                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-xs" title="{{ $testimonial->created_at->format('d/m/Y à H:i') }}">{{ $testimonial->formatted_date }}</span>
                    <div class="flex gap-2">
                        <button wire:click="toggleStatus({{ $testimonial->id }})"
                            class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded text-white text-xs">
                            {{ $testimonial->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                        <button wire:click="edit({{ $testimonial->id }})"
                            class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded text-white text-xs">
                            Modifier
                        </button>
                        <button wire:click="delete({{ $testimonial->id }})"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce témoignage ?')"
                            class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white text-xs">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-8 text-gray-400 text-center">
                <p>Aucun témoignage trouvé</p>
            </div>
        @endforelse

        <div class="mt-4">
            {{ $testimonials->links() }}
        </div>
    </div>

    <!-- Modal de formulaire -->
    @if ($showModal)
        <div class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-gray-800 mx-4 p-6 rounded-lg w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-white text-lg">
                        {{ $editingTestimonial ? 'Modifier le témoignage' : 'Nouveau témoignage' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Nom</label>
                        <input type="text" wire:model="name"
                            class="bg-gray-700 px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-white">
                        @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Message</label>
                        <textarea wire:model="message" rows="4"
                            class="bg-gray-700 px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-white"></textarea>
                        @error('message') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Note (1-5 étoiles)</label>
                        <select wire:model="rating"
                            class="bg-gray-700 px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-white">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        @error('rating') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Photo (optionnelle)</label>
                        <input type="file" wire:model="photo" accept="image/*"
                            class="bg-gray-700 px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-white">
                        @if ($existing_photo)
                            <div class="mt-2">
                                <span class="text-gray-400 text-sm">Photo actuelle:</span>
                                <img src="{{ asset('storage/' . $existing_photo) }}" alt="Photo actuelle" class="mt-1 rounded w-16 h-16 object-cover">
                            </div>
                        @endif
                        @if ($photo)
                            <div class="mt-2">
                                <span class="text-gray-400 text-sm">Nouvelle photo:</span>
                                <img src="{{ $photo->temporaryUrl() }}" alt="Aperçu" class="mt-1 rounded w-16 h-16 object-cover">
                            </div>
                        @endif
                        @error('photo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Date de création (optionnelle)</label>
                        <input type="datetime-local" wire:model="created_at"
                            class="bg-gray-700 px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-white">

                        <!-- Boutons prédéfinis -->
                        <div class="flex flex-wrap gap-2 mt-2">
                            <button type="button" wire:click="setCreatedAtToNow"
                                class="bg-teal-600 hover:bg-teal-700 px-2 py-1 rounded text-white text-xs">
                                Maintenant
                            </button>
                            <button type="button" wire:click="setCreatedAtToYesterday"
                                class="bg-teal-600 hover:bg-teal-700 px-2 py-1 rounded text-white text-xs">
                                Hier
                            </button>
                            <button type="button" wire:click="setCreatedAtToLastWeek"
                                class="bg-teal-600 hover:bg-teal-700 px-2 py-1 rounded text-white text-xs">
                                Il y a 1 semaine
                            </button>
                            <button type="button" wire:click="setCreatedAtToLastMonth"
                                class="bg-teal-600 hover:bg-teal-700 px-2 py-1 rounded text-white text-xs">
                                Il y a 1 mois
                            </button>
                            <button type="button" wire:click="$set('created_at', '')"
                                class="bg-gray-600 hover:bg-gray-700 px-2 py-1 rounded text-white text-xs">
                                Effacer
                            </button>
                        </div>

                        <small class="text-gray-400 text-xs">Laissez vide pour utiliser la date actuelle</small>
                        @error('created_at') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" wire:model="is_active" id="is_active"
                            class="bg-gray-700 mr-2 border-gray-600 rounded focus:ring-blue-500 text-blue-500">
                        <label for="is_active" class="text-gray-300 text-sm">Témoignage actif</label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" wire:click="closeModal"
                            class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-white">
                            Annuler
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md text-white">
                            {{ $editingTestimonial ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<div class="flex-1 px-2 sm:px-0">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-extralight text-white/50 text-3xl">Approbations de témoignages</h3>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 mb-4 p-4 rounded-md text-white">
            {{ session('message') }}
        </div>
    @endif

    <!-- Filtres et recherche -->
    <div class="flex md:flex-row flex-col gap-4 mb-6">
        <div class="relative">
            <input type="text" wire:model.live="search" placeholder="Rechercher..."
                class="bg-gray-900 py-2 pr-4 pl-10 rounded-md w-64 text-white">
            <svg class="top-2.5 left-3 absolute w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <div class="flex gap-2">
            <button wire:click="$set('statusFilter', 'pending')"
                class="px-4 py-2 rounded-md text-sm {{ $statusFilter === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                En attente ({{ $pendingCount }})
            </button>
            <button wire:click="$set('statusFilter', 'approved')"
                class="px-4 py-2 rounded-md text-sm {{ $statusFilter === 'approved' ? 'bg-green-500 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                Approuvés ({{ $approvedCount }})
            </button>
            <button wire:click="$set('statusFilter', 'rejected')"
                class="px-4 py-2 rounded-md text-sm {{ $statusFilter === 'rejected' ? 'bg-red-500 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                Rejetés ({{ $rejectedCount }})
            </button>
        </div>
    </div>

    <!-- Liste des témoignages -->
    <div class="space-y-4">
        @forelse ($testimonials as $testimonial)
            <div class="bg-gray-800 p-6 rounded-lg">
                <div class="flex md:flex-row flex-col md:justify-between md:items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex justify-center items-center bg-emerald-500 rounded-full w-10 h-10">
                                <span class="font-bold text-white">{{ strtoupper(substr($testimonial->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">{{ $testimonial->name }}</h4>
                                @if($testimonial->email)
                                    <p class="text-gray-400 text-sm">{{ $testimonial->email }}</p>
                                @endif
                            </div>
                            <div class="flex ml-auto text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimonial->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <p class="mb-3 text-gray-300">{{ Str::limit($testimonial->message, 200) }}</p>

                        <div class="flex justify-between items-center text-gray-400 text-sm">
                            <span>{{ $testimonial->created_at->format('d/m/Y à H:i') }}</span>
                            <span class="px-2 py-1 rounded text-xs
                                {{ $testimonial->status === 'pending' ? 'bg-yellow-600 text-white' : '' }}
                                {{ $testimonial->status === 'approved' ? 'bg-green-600 text-white' : '' }}
                                {{ $testimonial->status === 'rejected' ? 'bg-red-600 text-white' : '' }}">
                                @if($testimonial->status === 'pending') En attente
                                @elseif($testimonial->status === 'approved') Approuvé
                                @elseif($testimonial->status === 'rejected') Rejeté
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 md:ml-4">
                        @if($testimonial->status === 'pending')
                            <button wire:click="approve({{ $testimonial->id }})"
                                class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white text-sm">
                                Approuver
                            </button>
                            <button wire:click="reject({{ $testimonial->id }})"
                                class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white text-sm">
                                Rejeter
                            </button>
                        @elseif($testimonial->status === 'approved')
                            <button wire:click="reject({{ $testimonial->id }})"
                                class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white text-sm">
                                Rejeter
                            </button>
                        @elseif($testimonial->status === 'rejected')
                            <button wire:click="restore({{ $testimonial->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded text-white text-sm">
                                Remettre en attente
                            </button>
                            <button wire:click="approve({{ $testimonial->id }})"
                                class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white text-sm">
                                Approuver
                            </button>
                        @endif

                        <button wire:click="viewDetails({{ $testimonial->id }})"
                            class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-white text-sm">
                            Détails
                        </button>

                        <button wire:click="delete({{ $testimonial->id }})"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce témoignage ?')"
                            class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded text-white text-sm">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-8 text-gray-400 text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p>Aucun témoignage trouvé pour ce statut</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $testimonials->links() }}
    </div>

    <!-- Modal de détails -->
    @if ($showModal && $selectedTestimonial)
        <div class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-gray-800 mx-4 p-6 rounded-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-white text-lg">Détails du témoignage</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Nom</label>
                        <p class="text-white">{{ $selectedTestimonial->name }}</p>
                    </div>

                    @if($selectedTestimonial->email)
                        <div>
                            <label class="block mb-1 font-medium text-gray-300 text-sm">Email</label>
                            <p class="text-white">{{ $selectedTestimonial->email }}</p>
                        </div>
                    @endif

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Note</label>
                        <div class="flex text-yellow-400 text-lg">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $selectedTestimonial->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                            <span class="ml-2 text-white">({{ $selectedTestimonial->rating }}/5)</span>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Message</label>
                        <div class="bg-gray-700 p-4 border border-gray-600 rounded">
                            <p class="text-white whitespace-pre-wrap">{{ $selectedTestimonial->message }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Statut</label>
                        <span class="px-3 py-1 rounded text-sm
                            {{ $selectedTestimonial->status === 'pending' ? 'bg-yellow-600 text-white' : '' }}
                            {{ $selectedTestimonial->status === 'approved' ? 'bg-green-600 text-white' : '' }}
                            {{ $selectedTestimonial->status === 'rejected' ? 'bg-red-600 text-white' : '' }}">
                            @if($selectedTestimonial->status === 'pending') En attente
                            @elseif($selectedTestimonial->status === 'approved') Approuvé
                            @elseif($selectedTestimonial->status === 'rejected') Rejeté
                            @endif
                        </span>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-300 text-sm">Date de soumission</label>
                        <p class="text-white">{{ $selectedTestimonial->created_at->format('d/m/Y à H:i:s') }}</p>
                        <p class="text-gray-400 text-sm">{{ $selectedTestimonial->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6 pt-6 border-gray-700 border-t">
                    @if($selectedTestimonial->status === 'pending')
                        <button wire:click="approve({{ $selectedTestimonial->id }})"
                            class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-md text-white">
                            Approuver
                        </button>
                        <button wire:click="reject({{ $selectedTestimonial->id }})"
                            class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-white">
                            Rejeter
                        </button>
                    @elseif($selectedTestimonial->status === 'approved')
                        <button wire:click="reject({{ $selectedTestimonial->id }})"
                            class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-white">
                            Rejeter
                        </button>
                    @elseif($selectedTestimonial->status === 'rejected')
                        <button wire:click="restore({{ $selectedTestimonial->id }})"
                            class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded-md text-white">
                            Remettre en attente
                        </button>
                        <button wire:click="approve({{ $selectedTestimonial->id }})"
                            class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-md text-white">
                            Approuver
                        </button>
                    @endif
                    <button wire:click="closeModal"
                        class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-white">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

<div x-data="{
    isMenuOpen: @entangle('isMenuOpen'),
    topBarItems: {{ json_encode($topBarItems) }},
    currentTopBarItemIndex: @entangle('currentTopBarItemIndex'),
    startTopBarCarousel() {
        setInterval(() => {
            // Only update the carousel on mobile screens
            if (window.innerWidth < 768) {
                this.currentTopBarItemIndex =
                    (this.currentTopBarItemIndex + 1) % this.topBarItems.length;
            }
        }, 3000);
    }
}" x-init="startTopBarCarousel()" class="top-0 z-50 md:relative sticky bg-white">
    <!-- Desktop Top Bar (Fixed) -->
    <div class="hidden md:block bg-emerald-300 py-2 font-semibold text-white text-center">
        <div class="flex justify-center space-x-6">
            @foreach ($topBarItems as $item)
                <div class="flex items-center text-sm">
                    <span class="font-extrabold">
                        <x-heroicon-s-check class="mr-1 w-5 h-5 text-white" />

                    </span>
                    {{ $item }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mobile Top Bar Carousel -->
    <div class="md:hidden bg-emerald-600 py-2 font-semibold text-white text-center">
        <div class="flex justify-center items-center text-sm transition-opacity duration-500">
            <x-heroicon-s-check-circle class="mr-1 w-4 h-4 text-white" />
            <span x-text="topBarItems[currentTopBarItemIndex]"></span>
        </div>
    </div>

    <!-- Logo - Remove or hide this on mobile since we'll put it in the nav -->


    <!-- Main Navbar -->
    <nav class="bg-white">
        <div class="mx-auto px-4 py-3 max-w-screen-xl">
            <!-- Mobile Navigation (justify-between with 3 elements) -->
            <div class="md:hidden flex flex-row-reverse justify-between items-center">
                <!-- Burger Menu (left) -->
                <button wire:click="toggleMenu" class="hover:bg-emerald-300 p-2 text-gray-600 hover:text-white">
                    <x-heroicon-o-bars-3 class="w-6 h-6" />
                </button>



                <!-- Logo (center) -->
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-auto h-16" />
                </a>

                <!-- Shopping Cart (right) -->
                {{-- <div x-data="{ mobileCartOpen: false }" class="relative">
                    <button @click="mobileCartOpen = !mobileCartOpen"
                        class="relative hover:bg-emerald-300 p-2 text-gray-600 hover:text-white">
                        <x-heroicon-o-shopping-cart class="w-6 h-6" />
                        <span
                            class="-top-1 -right-1 absolute flex justify-center items-center bg-emerald-600 rounded-full w-4 h-4 text-white text-xs">{{ $cartItemCount }}</span>
                    </button>

                    <!-- Mobile Cart Dropdown -->
                    <div x-show="mobileCartOpen" @click.away="mobileCartOpen = false" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        wire:poll.visible class="right-0 z-50 absolute bg-slate-100 shadow-xl mt-2 rounded-lg w-xs">
                        <div class="p-4 max-h-96">
                            <h3 class="mb-2 pb-2 border-gray-200 border-b font-bold text-lg">Votre Panier
                                ({{ $cartItemCount }})</h3>

                            <!-- Cart Items -->
                            <div class="space-y-3 max-h-36 overflow-y-auto">
                                @if (!empty($cartItems))
                                    @forelse ($cartItems as $item)
                                        <div class="flex items-center space-x-3 py-2 border-gray-200 border-b">
                                            <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                                alt="{{ $item['product']['name'] ?? 'Produit' }}"
                                                class="rounded w-12 h-12 object-cover">
                                            <div class="flex-1">
                                                <h4 class="font-medium text-sm">{{ $item['product']['name'] }}</h4>
                                                <p class="text-gray-500 text-xs">Quantité: {{ $item['quantity'] }}</p>
                                            </div>
                                            <div class="font-medium text-emerald-700">{{ $item['product']['price'] }}€
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-gray-400 text-center">
                                            <p class="text-gray-500 text-center">Votre panier est vide.</p>
                                        </div>
                                    @endforelse
                                @else
                                    <div class="text-gray-400 text-center">
                                        <p class="text-gray-500 text-center">Votre panier est vide.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Cart Total -->
                            <div class="mt-4 pt-2 border-gray-200 border-t">
                                <div class="flex justify-between font-bold">
                                    <span>Total:</span>
                                    <span>
                                        @php
                                            $total = 0;
                                            if (!empty($cartItems)) {
                                                foreach ($cartItems as $item) {
                                                    $total += $item['product']['price'] * $item['quantity'];
                                                }
                                            }
                                            echo number_format($total, 2, ',', ' ');
                                        @endphp €
                                    </span>
                                </div>

                                <div class="space-y-2 mt-4">
                                    <a href="{{ route('cart') }}"
                                        class="block bg-gray-200 hover:bg-gray-300 py-2 rounded w-full font-medium text-sm text-center">
                                        Voir le panier
                                    </a>
                                    <a href="#" wire:click="removeCart()"
                                        class="block bg-emerald-300 hover:bg-emerald-800 py-2 rounded w-full font-medium text-white text-sm text-center">
                                        Effacer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Desktop Menu (remains unchanged) -->
            <div class="hidden md:flex justify-between">

                <div class="hidden md:flex justify-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('logo.png') }}" alt="Logo"
                            class="my-4 w-auto h-20" />
                    </a>
                </div>
                {{-- <hr class="bg-gray-100 w-24 text-gray-300" /> --}}
                <div class="flex justify-center items-center space-x-6">
                    <a href="{{ route('home') }}"
                        class="hover:bg-emerald-300 p-2 hover:rounded-lg text-gray-800 hover:text-white">ACCUEIL</a>
                    <a href="{{ route('contact') }}"
                        class="hover:bg-emerald-300 p-2 hover:rounded-lg text-gray-800 hover:text-white">CONTACT</a>
                    <a href="{{ route('meeting') }}"
                        class="hover:bg-emerald-300 p-2 hover:rounded-lg text-gray-800 hover:text-white">PRISE DE
                        RENDEZ-VOUS</a>
                </div>

                <div class="hidden md:flex justify-center items-center">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="hover:bg-emerald-300 p-2 hover:rounded-lg text-gray-800 hover:text-white">SE
                                DÉCONNECTER</button>
                        </form>
                        <a href="{{ route('profile') }}" class="hover:bg-emerald-300 p-2 text-gray-600 hover:text-white">
                            <x-heroicon-s-user class="w-6 h-6" />
                        </a>
                    @endauth
                    {{-- <button @click="$dispatch('open-search-modal')"
                        class="hover:bg-emerald-300 p-2 text-gray-600 hover:text-white">
                        <x-heroicon-s-magnifying-glass class="w-6 h-6" />
                    </button>
                    <div x-data="{ cartOpen: false }" class="relative">
                        <button @click="cartOpen = !cartOpen"
                            class="relative hover:bg-emerald-300 p-2 text-gray-600 hover:text-white">
                            <x-heroicon-s-shopping-cart class="w-6 h-6" />
                            <span
                                class="-top-1 -right-1 absolute flex justify-center items-center bg-emerald-600 rounded-full w-4 h-4 text-white text-xs">{{ $cartItemCount }}</span>
                        </button>

                        <!-- Cart Dropdown -->
                        <div x-show="cartOpen" @click.away="cartOpen = false" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            wire:poll.visible class="right-0 z-50 absolute bg-slate-100 shadow-xl mt-2 rounded-lg w-96">
                            <div class="p-4 max-h-96">
                                <h3 class="mb-2 pb-2 border-b font-bold text-lg">Votre Panier ({{ $cartItemCount }})
                                </h3>

                                <!-- Cart Items -->
                                <div class="space-y-3 max-h-36 overflow-y-auto">
                                    @if (!empty($cartItems))
                                        @forelse ($cartItems as $item)
                                            <div class="flex items-center space-x-3 py-2 border-b">
                                                <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                                    alt="{{ $item['product']['name'] ?? 'Produit' }}"
                                                    class="rounded w-12 h-12 object-cover">
                                                <div class="flex-1">
                                                    <h4 class="font-medium text-sm">{{ $item['product']['name'] }}
                                                    </h4>
                                                    <p class="text-gray-500 text-xs">Quantité:
                                                        {{ $item['quantity'] . ' x ' . $item['product']['price'] }}€
                                                    </p>
                                                </div>
                                                <div class="font-medium text-emerald-700">
                                                    {{ $item['product']['price'] }}€
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-gray-400 text-center">
                                                <p class="text-gray-500 text-center">Votre panier est vide.</p>
                                            </div>
                                        @endforelse
                                    @else
                                        <div class="text-gray-400 text-center">
                                            <p class="text-gray-500 text-center">Votre panier est vide.</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Cart Total -->
                                <div class="mt-4 pt-2 border-t">
                                    <div class="flex justify-between font-bold">
                                        <span>Total:</span>
                                        <span>
                                            @php
                                                $total = 0;
                                                if (!empty($cartItems)) {
                                                    foreach ($cartItems as $item) {
                                                        $total += $item['product']['price'] * $item['quantity'];
                                                    }
                                                }
                                                echo number_format($total, 2);
                                            @endphp €
                                        </span>
                                    </div>

                                    <div class="space-y-2 mt-4">
                                        <a href="{{ route('cart') }}"
                                            class="block bg-gray-200 hover:bg-gray-300 py-2 rounded w-full font-medium text-sm text-center">
                                            Voir le panier
                                        </a>
                                        <a href="#" wire:click="removeCart()"
                                            class="block bg-emerald-300 hover:bg-emerald-800 py-2 rounded w-full font-medium text-white text-sm text-center">
                                            Effacer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>




            </div>
        </div>

        <!-- Mobile Slide-out Menu with Search Bar -->
        <div x-cloak x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-full"
            class="md:hidden z-50 fixed inset-0 bg-white overflow-y-auto">
            <div class="relative p-4">
                <button @click="isMenuOpen = false" class="top-4 left-4 absolute text-gray-600 text-3xl">
                    &times;
                </button>

                <!-- Search Bar -->
                <div class="mt-12 mb-6">
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Rechercher..."
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 w-full">
                        <a href="{{ !empty($search) && strlen($search) >= 2 ? route('search', ['search' => $search]) : '#' }}"
                            @if (empty($search) || strlen($search) < 2) onclick="event.preventDefault(); alert('Veuillez saisir au moins 2 caractères');" @endif
                            class="top-2.5 right-3 absolute text-gray-500 hover:text-emerald-600">
                            <x-heroicon-s-magnifying-glass class="w-5 h-5" />
                        </a>
                    </div>
                    @if (!empty($search) && strlen($search) < 2)
                        <p class="mt-1 text-emerald-500 text-xs">Veuillez saisir au moins 2 caractères</p>
                    @endif
                </div>

                <!-- Mobile Menu Items - Centered with hover effects -->
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}"
                        class="hover:bg-emerald-800 py-2 text-gray-800 hover:text-white text-xl text-center">ACCUEIL</a>
                    <a href="{{ route('contact') }}"
                        class="hover:bg-emerald-800 py-2 text-gray-800 hover:text-white text-xl text-center">CONTACT</a>
                    <a href="{{ route('meeting') }}"
                        class="hover:bg-emerald-800 py-2 text-gray-800 hover:text-white text-xl text-center">PRISE DE
                        RENDEZ-VOUS</a>


                    @auth
                        <a href="{{ route('profile') }}"
                            class="hover:bg-emerald-800 py-2 text-gray-800 hover:text-white text-xl text-center">MON
                            COMPTE</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="hover:bg-emerald-800 py-2 w-full text-gray-800 hover:text-white text-xl text-center">SE
                                DÉCONNECTER</button>
                        </form>
                    @endauth

                </div>
            </div>
        </div>
    </nav>
    <div x-data="{ isOpen: false }" @open-search-modal.window="isOpen = true" @keydown.escape.window="isOpen = false">

        <!-- Overlay du modal -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="isOpen = false" x-cloak
            class="z-50 fixed inset-0 flex justify-center items-center bg-black/50 bg-blend-multiply bg-opacity-50 p-4">

            <!-- Contenu du modal -->
            <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" @click.stop
                class="bg-white shadow-xl rounded-lg w-full max-w-2xl overflow-hidden">

                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-900 text-xl">Rechercher</h3>
                        <button @click="isOpen = false" class="text-gray-500 hover:text-gray-700">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>

                    <!-- Formulaire de recherche -->
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Que recherchez-vous ?"
                            @keydown.enter="if (search.length >= 2) { window.location.href = '{{ route('search') }}/' + $wire.search }"
                            class="px-5 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 w-full text-lg"
                            x-ref="searchInput" x-init="$nextTick(() => $refs.searchInput.focus())">

                        <a href="{{ route('search') }}/{{ '${$wire.search}' }}"
                            :class="{
                                'cursor-not-allowed opacity-50': $wire.search.length < 2,
                                'hover:bg-emerald-300': $wire.search
                                    .length >= 2
                            }"
                            @click.prevent="$wire.search.length >= 2 ? window.location.href = '{{ route('search') }}/' + $wire.search : ''"
                            class="top-2 right-2 absolute bg-emerald-600 p-2 rounded-md text-white">
                            <x-heroicon-s-magnifying-glass class="w-6 h-6" />
                        </a>
                    </div>

                    <!-- Message d'aide -->
                    <p class="mt-3 text-gray-500 text-sm">
                        <span x-show="$wire.search.length < 2">Veuillez saisir au moins 2 caractères pour lancer la
                            recherche</span>
                        <span x-show="$wire.search.length >= 2">Appuyez sur Entrée ou cliquez sur l'icône pour
                            rechercher</span>
                    </p>

                    <!-- Suggestions populaires -->
                    <div class="mt-6" x-show="$wire.search.length < 2">
                        <h4 class="mb-2 font-medium text-gray-500 text-sm">Recherches populaires :</h4>
                        <div class="flex flex-wrap gap-2">
                            <button
                                @click="$wire.search = 'cartes'; window.location.href = '{{ route('search') }}/cartes'"
                                class="bg-gray-100 hover:bg-emerald-50 px-3 py-1 rounded-full text-gray-700 hover:text-emerald-700 text-sm">
                                Cartes
                            </button>
                            <button
                                @click="$wire.search = 'tarot'; window.location.href = '{{ route('search') }}/tarot'"
                                class="bg-gray-100 hover:bg-emerald-50 px-3 py-1 rounded-full text-gray-700 hover:text-emerald-700 text-sm">
                                Tarot
                            </button>
                            <button
                                @click="$wire.search = 'pendule'; window.location.href = '{{ route('search') }}/pendule'"
                                class="bg-gray-100 hover:bg-emerald-50 px-3 py-1 rounded-full text-gray-700 hover:text-emerald-700 text-sm">
                                Pendule
                            </button>
                            <button
                                @click="$wire.search = 'oracle'; window.location.href = '{{ route('search') }}/oracle'"
                                class="bg-gray-100 hover:bg-emerald-50 px-3 py-1 rounded-full text-gray-700 hover:text-emerald-700 text-sm">
                                Oracle
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal de recherche -->


<!-- À la fin de navbar.blade.php, avant la fermeture de la div principale: -->
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('cartUpdated', () => {
            // Force Alpine.js to recompute the cart items
            Alpine.store('cart', {
                items: @json(session('cart') ?? [])
            });
        });
    });
</script>

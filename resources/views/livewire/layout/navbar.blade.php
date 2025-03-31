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
}" x-init="startTopBarCarousel()">
    <!-- Desktop Top Bar (Fixed) -->
    <div class="bg-red-700 text-white text-center py-2 hidden md:block font-semibold">
        <div class="flex justify-center space-x-6">
            @foreach ($topBarItems as $item)
                <div class="text-sm flex items-center">
                    <span class="font-extrabold ">
                        <x-heroicon-s-check class="h-5 w-5 mr-1 text-white " />

                    </span>
                    {{ $item }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mobile Top Bar Carousel -->
    <div class="bg-red-600 text-white text-center py-2 md:hidden font-semibold">
        <div class="text-sm transition-opacity duration-500 flex items-center justify-center">
            <x-heroicon-s-check-circle class="h-4 w-4 mr-1 text-white" />
            <span x-text="topBarItems[currentTopBarItemIndex]"></span>
        </div>
    </div>

    <!-- Logo - Remove or hide this on mobile since we'll put it in the nav -->
    <div class="flex justify-center items-center mx-auto hidden md:flex">
        <img src="{{ asset('assets/images/layout/logo.webp') }}" alt="Logo" class="h-40 w-auto my-4" />
    </div>

    <!-- Main Navbar -->
    <nav class="bg-white ">
        <div class="max-w-screen-xl mx-auto px-4 py-3">
            <!-- Mobile Navigation (justify-between with 3 elements) -->
            <div class="md:hidden flex items-center justify-between">
                <!-- Burger Menu (left) -->
                <button wire:click="toggleMenu" class="text-gray-600 hover:text-white hover:bg-red-700 p-2">
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>

                <!-- Logo (center) -->
                <img src="{{ asset('assets/images/layout/logo.webp') }}" alt="Logo" class="h-16 w-auto" />

                <!-- Shopping Cart (right) -->
                <div x-data="{ mobileCartOpen: false }" class="relative">
                    <button @click="mobileCartOpen = !mobileCartOpen"
                        class="text-gray-600 hover:text-white hover:bg-red-700 p-2 relative">
                        <x-heroicon-o-shopping-cart class="h-6 w-6" />
                        <span
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">{{ $cartItemCount }}</span>
                    </button>

                    <!-- Mobile Cart Dropdown -->
                    <div x-show="mobileCartOpen" @click.away="mobileCartOpen = false" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        wire:poll.visible class="absolute right-0 mt-2 w-xs bg-slate-100 rounded-lg shadow-xl z-50">
                        <div class="p-4 max-h-96">
                            <h3 class="text-lg font-bold border-b border-gray-200 pb-2 mb-2">Votre Panier
                                ({{ $cartItemCount }})</h3>

                            <!-- Cart Items -->
                            <div class="space-y-3 max-h-36 overflow-y-auto">
                                @if (!empty($cartItems))
                                    @forelse ($cartItems as $item)
                                        <div class="flex items-center space-x-3 py-2 border-b border-gray-200">
                                            <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                                alt="{{ $item['product']['name'] ?? 'Produit' }}"
                                                class="w-12 h-12 object-cover rounded">
                                            <div class="flex-1">
                                                <h4 class="text-sm font-medium">{{ $item['product']['name'] }}</h4>
                                                <p class="text-xs text-gray-500">Quantité: {{ $item['quantity'] }}</p>
                                            </div>
                                            <div class="text-red-700 font-medium">{{ $item['product']['price'] }}€
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-gray-400">
                                            <p class="text-center text-gray-500">Votre panier est vide.</p>
                                        </div>
                                    @endforelse
                                @else
                                    <div class="text-center text-gray-400">
                                        <p class="text-center text-gray-500">Votre panier est vide.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Cart Total -->
                            <div class="mt-4 pt-2 border-t border-gray-200">
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

                                <div class="mt-4 space-y-2">
                                    <a href="{{ route('cart') }}"
                                        class="block w-full bg-gray-200 text-center py-2 rounded hover:bg-gray-300 text-sm font-medium">
                                        Voir le panier
                                    </a>
                                    <a href="#" wire:click="removeCart()"
                                        class="block w-full bg-red-700 text-white text-center py-2 rounded hover:bg-red-800 text-sm font-medium">
                                        Effacer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Menu (remains unchanged) -->
            <div class="hidden md:flex justify-center  items-center space-x-6">
                <hr class="w-24 text-gray-300  bg-gray-100" />
                <a href="{{ route('home') }}"
                    class="text-gray-800 hover:text-white hover:bg-red-700 p-2 hover:rounded-lg">ACCUEIL</a>
                <a href="{{ route('shop') }}"
                    class="text-gray-800 hover:text-white hover:bg-red-700 p-2 hover:rounded-lg">BOUTIQUE</a>
                <a href="{{ route('contact') }}"
                    class="text-gray-800 hover:text-white hover:bg-red-700 p-2 hover:rounded-lg">CONTACT</a>
                <a href="{{ route('meeting') }}"
                    class="text-gray-800 hover:text-white hover:bg-red-700 p-2 hover:rounded-lg">PRISE DE
                    RENDEZ-VOUS</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-gray-800 hover:text-white hover:bg-red-700 p-2 hover:rounded-lg">SE
                            DÉCONNECTER</button>
                    </form>

                @endauth


                <a href="{{ route('profile') }}" class="text-gray-600 hover:text-white hover:bg-red-700 p-2">
                    <x-heroicon-s-user class="h-6 w-6" />
                </a>
                <button @click="$dispatch('open-search-modal')"
                    class="text-gray-600 hover:text-white hover:bg-red-700 p-2">
                    <x-heroicon-s-magnifying-glass class="h-6 w-6" />
                </button>
                <div x-data="{ cartOpen: false }" class="relative">
                    <button @click="cartOpen = !cartOpen"
                        class="text-gray-600 hover:text-white hover:bg-red-700 p-2 relative">
                        <x-heroicon-s-shopping-cart class="h-6 w-6" />
                        <span
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">{{ $cartItemCount }}</span>
                    </button>

                    <!-- Cart Dropdown -->
                    <div x-show="cartOpen" @click.away="cartOpen = false" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        wire:poll.visible class="absolute right-0 mt-2 w-96  bg-slate-100 rounded-lg shadow-xl z-50">
                        <div class="p-4 max-h-96 ">
                            <h3 class="text-lg font-bold border-b pb-2 mb-2">Votre Panier ({{ $cartItemCount }})</h3>

                            <!-- Cart Items -->
                            <div class="space-y-3 max-h-36 overflow-y-auto">
                                @if (!empty($cartItems))
                                    @forelse ($cartItems as $item)
                                        <div class="flex items-center space-x-3 py-2 border-b">
                                            <img src="{{ asset('storage/' . ($item['product']['images'][0] ?? '')) }}"
                                                alt="{{ $item['product']['name'] ?? 'Produit' }}"
                                                class="w-12 h-12 object-cover rounded">
                                            <div class="flex-1">
                                                <h4 class="text-sm font-medium">{{ $item['product']['name'] }}</h4>
                                                <p class="text-xs text-gray-500">Quantité:
                                                    {{ $item['quantity'] . ' x ' . $item['product']['price'] }}€</p>
                                            </div>
                                            <div class="text-red-700 font-medium">{{ $item['product']['price'] }}€
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-gray-400">
                                            <p class="text-center text-gray-500">Votre panier est vide.</p>
                                        </div>
                                    @endforelse
                                @else
                                    <div class="text-center text-gray-400">
                                        <p class="text-center text-gray-500">Votre panier est vide.</p>
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

                                <div class="mt-4 space-y-2">
                                    <a href="{{ route('cart') }}"
                                        class="block w-full bg-gray-200 text-center py-2 rounded hover:bg-gray-300 text-sm font-medium">
                                        Voir le panier
                                    </a>
                                    <a href="#" wire:click="removeCart()"
                                        class="block w-full bg-red-700 text-white text-center py-2 rounded hover:bg-red-800 text-sm font-medium">
                                        Effacer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="w-24 text-gray-300   bg-gray-100 " />
            </div>
        </div>

        <!-- Mobile Slide-out Menu with Search Bar -->
        <div x-cloak x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-full"
            class="fixed inset-0 bg-white z-50 md:hidden overflow-y-auto">
            <div class="p-4 relative">
                <button @click="isMenuOpen = false" class="absolute top-4 left-4 text-gray-600 text-3xl">
                    &times;
                </button>

                <!-- Search Bar -->
                <div class="mt-12 mb-6">
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Rechercher..."
                            class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                        <a href="{{ !empty($search) && strlen($search) >= 2 ? route('search', ['search' => $search]) : '#' }}"
                            @if (empty($search) || strlen($search) < 2) onclick="event.preventDefault(); alert('Veuillez saisir au moins 2 caractères');" @endif
                            class="absolute right-3 top-2.5 text-gray-500 hover:text-red-600">
                            <x-heroicon-s-magnifying-glass class="h-5 w-5" />
                        </a>
                    </div>
                    @if (!empty($search) && strlen($search) < 2)
                        <p class="text-red-500 text-xs mt-1">Veuillez saisir au moins 2 caractères</p>
                    @endif
                </div>

                <!-- Mobile Menu Items - Centered with hover effects -->
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}"
                        class="text-gray-800 text-xl text-center py-2 hover:text-white hover:bg-red-800">ACCUEIL</a>
                    <a href="{{ route('shop') }}"
                        class="text-gray-800 text-xl text-center py-2 hover:text-white hover:bg-red-800">BOUTIQUE</a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-800 text-xl text-center py-2 hover:text-white hover:bg-red-800">CONTACT</a>
                    <a href="{{ route('meeting') }}"
                        class="text-gray-800 text-xl text-center py-2 hover:text-white hover:bg-red-800">PRISE DE
                        RENDEZ-VOUS</a>
                    <a href="{{ route('profile') }}"
                        class="text-gray-800 text-xl text-center py-2 hover:text-white hover:bg-red-800">MON COMPTE</a>

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-gray-800 text-xl text-center py-2 hover:text-white hover:bg-red-800 w-full">SE
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
            class="fixed inset-0 bg-black/50 bg-blend-multiply bg-opacity-50 z-50 flex items-center justify-center p-4">

            <!-- Contenu du modal -->
            <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" @click.stop
                class="bg-white rounded-lg shadow-xl w-full max-w-2xl overflow-hidden">

                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">Rechercher</h3>
                        <button @click="isOpen = false" class="text-gray-500 hover:text-gray-700">
                            <x-heroicon-o-x-mark class="h-6 w-6" />
                        </button>
                    </div>

                    <!-- Formulaire de recherche -->
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Que recherchez-vous ?"
                            @keydown.enter="if (search.length >= 2) { window.location.href = '{{ route('search') }}/' + $wire.search }"
                            class="w-full py-4 px-5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 text-lg"
                            x-ref="searchInput" x-init="$nextTick(() => $refs.searchInput.focus())">

                        <a href="{{ route('search') }}/{{ '${$wire.search}' }}"
                            :class="{
                                'cursor-not-allowed opacity-50': $wire.search.length < 2,
                                'hover:bg-red-700': $wire.search
                                    .length >= 2
                            }"
                            @click.prevent="$wire.search.length >= 2 ? window.location.href = '{{ route('search') }}/' + $wire.search : ''"
                            class="absolute right-2 top-2 bg-red-600 text-white p-2 rounded-md">
                            <x-heroicon-s-magnifying-glass class="h-6 w-6" />
                        </a>
                    </div>

                    <!-- Message d'aide -->
                    <p class="mt-3 text-sm text-gray-500">
                        <span x-show="$wire.search.length < 2">Veuillez saisir au moins 2 caractères pour lancer la
                            recherche</span>
                        <span x-show="$wire.search.length >= 2">Appuyez sur Entrée ou cliquez sur l'icône pour
                            rechercher</span>
                    </p>

                    <!-- Suggestions populaires -->
                    <div class="mt-6" x-show="$wire.search.length < 2">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Recherches populaires :</h4>
                        <div class="flex flex-wrap gap-2">
                            <button
                                @click="$wire.search = 'cartes'; window.location.href = '{{ route('search') }}/cartes'"
                                class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-red-50 hover:text-red-700">
                                Cartes
                            </button>
                            <button
                                @click="$wire.search = 'tarot'; window.location.href = '{{ route('search') }}/tarot'"
                                class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-red-50 hover:text-red-700">
                                Tarot
                            </button>
                            <button
                                @click="$wire.search = 'pendule'; window.location.href = '{{ route('search') }}/pendule'"
                                class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-red-50 hover:text-red-700">
                                Pendule
                            </button>
                            <button
                                @click="$wire.search = 'oracle'; window.location.href = '{{ route('search') }}/oracle'"
                                class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-red-50 hover:text-red-700">
                                Oracle
                            </button>
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

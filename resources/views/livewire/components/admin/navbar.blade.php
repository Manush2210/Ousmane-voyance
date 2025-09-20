<div>
    <!-- Menu Toggle Button -->
    <button id="menu-toggle" class="top-4 left-4 z-50 fixed bg-gray-900 hover:bg-gray-800 p-2 rounded-md text-white">
        <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="hidden w-6 h-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Sidebar -->
    <div id="sidebar"
        class="top-0 left-0 z-40 fixed flex flex-col justify-between bg-gray-900 py-4 pt-24 w-0 h-full overflow-hidden transition-all duration-300">
        <nav class="flex flex-col items-center space-y-2">
            <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.orders') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.orders') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span class="ml-3">Commandes</span>
            </a>

            <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.users') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.users') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="ml-3">Utilisateurs</span>
            </a>

            <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.products') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.products') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span class="ml-3">Produits</span>
            </a>

            {{-- <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.payment-methods') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.payment-methods') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span class="ml-3">Moyens de Paiement</span>
            </a> --}}

            <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.consultation-types') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.consultation-types') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span class="ml-3">Types de Consultation</span>
            </a>

            <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.testimonials') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.testimonials') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="ml-3">Témoignages</span>
            </a>

            <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.accounts.add') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.accounts.add') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                    <path fill-rule="evenodd"
                        d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Ajouter Compte</span>
            </a>
        </nav>
        <div class="flex flex-col items-center space-y-2">
            <a class="text-white/50 p-4 inline-flex items-center rounded-md hover:bg-gray-800 hover:text-white smooth-hover w-full {{ request()->routeIs('admin.settings') ? 'bg-gray-800 text-white' : '' }}"
                href="{{ route('admin.settings') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Paramètres</span>
            </a>
            <a class="inline-flex items-center hover:bg-gray-800 p-4 rounded-md w-full text-white/50 hover:text-white smooth-hover"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-6 h-5 sm:h-6" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Déconnexion</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>

    <!-- Overlay to close menu on click outside -->
    <div id="sidebar-overlay"
        class="z-30 fixed inset-0 bg-black opacity-0 transition-opacity duration-300 pointer-events-none"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            function openMenu() {
                sidebar.classList.remove('w-0');
                sidebar.classList.add('w-64');
                overlay.classList.add('opacity-50');
                overlay.classList.remove('pointer-events-none');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            }

            function closeMenu() {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-0');
                overlay.classList.remove('opacity-50');
                overlay.classList.add('pointer-events-none');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }

            menuToggle.addEventListener('click', function() {
                if (sidebar.classList.contains('w-0')) {
                    openMenu();
                } else {
                    closeMenu();
                }
            });

            overlay.addEventListener('click', function() {
                closeMenu();
            });
        });
    </script>
</div>

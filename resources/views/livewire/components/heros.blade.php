<div class="relative bg-cover bg-center" style="background-image: url({{ asset('assets/images/19487.jpg') }});">
    <div class="bg-black/60">
        <div class="relative mx-auto py-24 container">
            <div class="max-w-4xl text-white text-left">
                <h1 class="drop-shadow-sm font-['Playfair_Display'] font-bold text-5xl md:text-7xl tracking-tight">
                    Le monde d'Auxane Voyance
                </h1>
                <p class="mt-6 max-w-2xl text-white/90 text-lg">Bienvenue dans l'univers d'Auxane Voyance, où la clarté et la compréhension vous attendent. Faites votre expérience aujourd'hui.</p>

                <div class="flex flex-wrap gap-4 mt-8">
                    <!-- Bouton Email -->
                    <a href="mailto:{{ App\Models\Setting::get('email') ?? 'contact@votresite.com' }}"
                       class="inline-flex justify-center items-center bg-emerald-600 hover:bg-emerald-700 shadow-lg backdrop-blur-sm px-6 py-3 border border-white/20 rounded-lg font-semibold text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        Email
                    </a>

                    <!-- Bouton WhatsApp -->
                    <a href="https://wa.me/{{ App\Models\Setting::get('contact_phone') ?? '33612345678' }}"
                       target="_blank" rel="noopener"
                       class="inline-flex justify-center items-center bg-green-500 hover:bg-green-600 shadow-lg backdrop-blur-sm px-6 py-3 border border-white/20 rounded-lg font-semibold text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16.6 14c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.6.7-.8.9-.1.1-.3.2-.5.1-.2-.1-.9-.3-1.8-1.1-.7-.6-1.1-1.4-1.3-1.6-.1-.2 0-.4.1-.5.1-.1.2-.2.4-.4.1-.1.2-.2.2-.4.1-.1.1-.3 0-.4-.1-.1-.6-1.5-.8-2-.2-.5-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2 1 2.4c.1.1 1.5 2.3 3.7 3.2.5.2.9.4 1.2.5.5.2 1 .1 1.3-.1.4-.2 1.5-1.2 1.7-1.6.2-.4.2-.8.1-.9l-.3-.1zM12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8z"/>
                        </svg>
                        WhatsApp
                    </a>

                    <!-- Bouton Instagram -->
                    {{-- <a href="{{ App\Models\Setting::get('insta_link') ?? '#' }}"
                       target="_blank" rel="noopener"
                       class="inline-flex justify-center items-center bg-gradient-to-r from-pink-500 hover:from-pink-600 via-red-500 hover:via-red-600 to-yellow-500 hover:to-yellow-600 shadow-lg backdrop-blur-sm px-6 py-3 border border-white/20 rounded-lg font-semibold text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                        Instagram
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>

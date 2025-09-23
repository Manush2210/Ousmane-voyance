<div class="bg-gray-50">
    <div class="py-16 sm:py-24">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <!-- Conteneur principal avec effet de carte -->
            <div class="relative grid grid-cols-1 lg:grid-cols-2 bg-white shadow-2xl rounded-2xl overflow-hidden">

                <!-- Section Gauche : Informations de contact et Vidéo -->
                <div class="relative px-8 sm:px-12 py-12">
                    <h1 class="font-extrabold text-gray-900 text-3xl sm:text-4xl tracking-tight">Entrons en contact</h1>
                    <p class="mt-4 text-gray-500 text-lg">
                        Remplissez le formulaire ou utilisez l'une des méthodes ci-dessous pour nous joindre. Nous sommes impatients d'échanger avec vous.
                    </p>

                    <!-- Coordonnées -->
                    <dl class="space-y-6 mt-10 text-gray-500 text-base">
                        <div class="flex gap-3">
                            <dt class="flex-shrink-0">
                                <span class="sr-only">Adresse e-mail</span>
                                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </dt>
                            <dd><a class="text-teal-600 hover:text-teal-800" href="mailto:{{ App\Models\Setting::get('email') ?? 'contact@votresite.com' }}">{{ App\Models\Setting::get('email') ?? 'contact@votresite.com' }}</a></dd>
                        </div>
                        <div class="flex gap-3">
                            <dt class="flex-shrink-0">
                                <span class="sr-only">Numéro de téléphone</span>
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16.6 14c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.6.7-.8.9-.1.1-.3.2-.5.1-.2-.1-.9-.3-1.8-1.1-.7-.6-1.1-1.4-1.3-1.6-.1-.2 0-.4.1-.5.1-.1.2-.2.4-.4.1-.1.2-.2.2-.4.1-.1.1-.3 0-.4-.1-.1-.6-1.5-.8-2-.2-.5-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2 1 2.4c.1.1 1.5 2.3 3.7 3.2.5.2.9.4 1.2.5.5.2 1 .1 1.3-.1.4-.2 1.5-1.2 1.7-1.6.2-.4.2-.8.1-.9l-.3-.1zM12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8z"/>
                                </svg>
                            </dt>
                            <dd><a class="text-teal-600 hover:text-teal-800" href="https://wa.me/{{ App\Models\Setting::get('contact_phone') ?? '33612345678' }}" target="_blank" rel="noopener">{{ App\Models\Setting::get('contact_phone') ?? '+33 6 12 34 56 78' }} (WhatsApp)</a></dd>
                        </div>
                        @if(App\Models\Setting::get('insta_link'))
                        <div class="flex gap-3">
                            <dt class="flex-shrink-0">
                                <span class="sr-only">Instagram</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </dt>
                            <dd><a class="text-teal-600 hover:text-teal-800" href="{{ App\Models\Setting::get('insta_link') }}" target="_blank" rel="noopener">Instagram</a></dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Section Droite : Formulaire -->
                <div class="px-8 sm:px-12 py-12 lg:border-gray-200 lg:border-l">
                    <h2 class="font-bold text-gray-900 text-2xl sm:text-3xl tracking-tight">Envoyez-nous un message</h2>

                    <form wire:submit="submit" class="space-y-6 mt-8">
                        <!-- Messages de session (Succès / Erreur) -->
                        @if (session()->has('success'))
                            <div class="bg-green-50 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <div class="ml-3"><p class="font-medium text-green-800 text-sm">{{ session('success') }}</p></div>
                                </div>
                            </div>
                        @endif
                         @if (session()->has('error'))
                             <div class="bg-red-50 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0"><svg class="w-5 h-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" /></svg></div>
                                    <div class="ml-3"><p class="font-medium text-red-800 text-sm">{{ session('error') }}</p></div>
                                </div>
                            </div>
                        @endif

                        <!-- Champ Nom -->
                        <div>
                            <label for="name" class="sr-only">Nom complet</label>
                            <div class="relative">
                                <input type="text" id="name" wire:model="name" class="block shadow-sm px-4 py-3 border-gray-300 focus:border-teal-500 rounded-md focus:ring-teal-500 w-full placeholder-gray-400" placeholder="Nom complet*" required>
                                @error('name')<p class="mt-2 text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <!-- Champ Email -->
                        <div>
                            <label for="email" class="sr-only">Adresse e-mail</label>
                            <div class="relative">
                                <input type="email" id="email" wire:model="email" class="block shadow-sm px-4 py-3 border-gray-300 focus:border-teal-500 rounded-md focus:ring-teal-500 w-full placeholder-gray-400" placeholder="Adresse e-mail*" required>
                                @error('email')<p class="mt-2 text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <!-- Champ Message -->
                        <div>
                            <label for="message" class="sr-only">Message</label>
                            <div class="relative">
                                <textarea id="message" wire:model="message" rows="4" class="block shadow-sm px-4 py-3 border-gray-300 focus:border-teal-500 rounded-md focus:ring-teal-500 w-full placeholder-gray-400" placeholder="Votre message*" required></textarea>
                                @error('message')<p class="mt-2 text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <!-- Honeypot (sécurité anti-spam) -->
                        <div class="sr-only">
                            <label for="email_confirm">Ne pas remplir ce champ</label>
                            <input type="text" id="email_confirm" wire:model.defer="email_confirm" tabindex="-1" autocomplete="off">
                        </div>

                        <!-- Cloudflare Turnstile (sécurité anti-bot) -->
                        <div wire:ignore>
                            <div class="cf-turnstile" data-sitekey="{{ config('services.cloudflare.site_key') }}" data-callback="onTurnstileSuccess" data-size="normal"></div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div>
                            <button type="submit"
                                class="flex justify-center bg-teal-600 hover:bg-teal-700 disabled:opacity-50 shadow-sm px-4 py-3 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 w-full font-medium text-white text-base">
                                <span wire:loading.remove wire:target="submit">Envoyer le message</span>
                                <span wire:loading wire:target="submit" class="flex items-center">
                                    <svg class="mr-2 w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Envoi en cours...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @push('scripts')
    <!-- Script pour Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script>
        // Callback pour envoyer le token Turnstile au composant Livewire
        function onTurnstileSuccess(token) {
            if (token) {
                @this.set('turnstileToken', token);
            }
        }
    </script>
@endpush --}}
@push('scripts')
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded');
        });
        // Callback quand Turnstile est validé avec succès
        function onTurnstileSuccess(token) {
            // Le token est automatiquement ajouté au formulaire dans un champ caché cf-turnstile-response
            if (token) {
                @this.set('turnstileToken', token);


            }
        }

        // Callback quand le token Turnstile expire
        function onTurnstileExpired() {
            console.log('Le token Turnstile a expiré, veuillez recharger la page');
        }
    </script>
@endpush

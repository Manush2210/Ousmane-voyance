<div class="flex justify-center items-center bg-gray-900 min-h-screen">
    <div class="bg-gray-800 shadow-lg p-8 rounded-lg w-full max-w-md">
        <div class="mb-6 text-center">
            <img src="{{ asset('assets/images/layout/logo.png') }}" alt="Logo" class="mx-auto mb-4 h-16">
            <h2 class="font-bold text-white text-2xl">Administration</h2>
            <p class="text-gray-400">Connectez-vous à votre compte administrateur</p>
        </div>

        @if (session()->has('error'))
            <div class="bg-emerald-500 mb-4 p-3 rounded text-white">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit="login" class="space-y-6">
            <div>
                <label for="email" class="block font-medium text-gray-300 text-sm">Email</label>
                <input wire:model="email" type="email" id="email"
                    class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white">
                @error('email')
                    <span class="text-emerald-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-300 text-sm">Mot de passe</label>
                <input wire:model="password" type="password" id="password"
                    class="block bg-gray-700 mt-1 px-3 py-2 border border-gray-600 focus:border-emerald-500 rounded-md focus:outline-none focus:ring-emerald-500 w-full text-white">
                @error('password')
                    <span class="text-emerald-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <input wire:model="remember" id="remember" type="checkbox"
                        class="bg-gray-700 border-gray-600 rounded focus:ring-emerald-500 w-4 h-4 text-emerald-600">
                    <label for="remember" class="block ml-2 text-gray-300 text-sm">Se souvenir de moi</label>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex justify-center bg-emerald-600 hover:bg-emerald-300 shadow-sm px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 w-full font-medium text-white text-sm">
                    <span wire:loading.remove>Connexion</span>
                    <span wire:loading>Connexion en cours...</span>
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-300 text-sm">
                « Retour au site
            </a>
        </div>
    </div>
</div>

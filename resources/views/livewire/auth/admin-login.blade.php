<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <img src="{{ asset('assets/images/layout/logo.png') }}" alt="Logo" class="h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-white">Administration</h2>
            <p class="text-gray-400">Connectez-vous à votre compte administrateur</p>
        </div>

        @if (session()->has('error'))
            <div class="bg-purple-500 text-white p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit="login" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input wire:model="email" type="email" id="email"
                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                @error('email')
                    <span class="text-purple-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Mot de passe</label>
                <input wire:model="password" type="password" id="password"
                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                @error('password')
                    <span class="text-purple-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input wire:model="remember" id="remember" type="checkbox"
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-600 rounded bg-gray-700">
                    <label for="remember" class="ml-2 block text-sm text-gray-300">Se souvenir de moi</label>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <span wire:loading.remove>Connexion</span>
                    <span wire:loading>Connexion en cours...</span>
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-gray-300">
                « Retour au site
            </a>
        </div>
    </div>
</div>

<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-purple-100 text-purple-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="login">
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Adresse e-mail</label>
            <input type="email" id="email" wire:model="email"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('email')
                <span class="text-purple-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
            <input type="password" id="password" wire:model="password"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('password')
                <span class="text-purple-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center mb-6">
            <input type="checkbox" id="remember" wire:model="remember" class="h-4 w-4 text-purple-600">
            <label for="remember" class="ml-2 text-gray-700">Se souvenir de moi</label>
        </div>

        <button type="submit"
            class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-300 transition duration-200">
            Se connecter
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="#" class="text-sm text-purple-600 hover:underline">Mot de passe oublié?</a>
        <p class="mt-2 text-gray-600">
            Pas encore de compte?
            <a href="{{ route('register') }}" class="text-purple-600 hover:underline">S'inscrire</a>
        </p>
    </div>
</div>

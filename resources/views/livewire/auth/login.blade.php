<div class="bg-white shadow-md mx-auto mt-10 p-6 rounded-lg max-w-md">
    <h2 class="mb-6 font-bold text-gray-800 text-2xl text-center">Connexion</h2>

    @if (session()->has('message'))
        <div class="bg-emerald-100 mb-4 p-3 rounded text-emerald-700">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="login">
        <div class="mb-4">
            <label for="email" class="block mb-2 font-medium text-gray-700">Adresse e-mail</label>
            <input type="email" id="email" wire:model="email"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full">
            @error('email')
                <span class="text-emerald-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-2 font-medium text-gray-700">Mot de passe</label>
            <input type="password" id="password" wire:model="password"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full">
            @error('password')
                <span class="text-emerald-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center mb-6">
            <input type="checkbox" id="remember" wire:model="remember" class="w-4 h-4 text-emerald-600">
            <label for="remember" class="ml-2 text-gray-700">Se souvenir de moi</label>
        </div>

        <button type="submit"
            class="bg-emerald-600 hover:bg-emerald-300 px-4 py-2 rounded-lg w-full text-white transition duration-200">
            Se connecter
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="#" class="text-emerald-600 text-sm hover:underline">Mot de passe oublié?</a>
        <p class="mt-2 text-gray-600">
            Pas encore de compte?
            <a href="{{ route('register') }}" class="text-emerald-600 hover:underline">S'inscrire</a>
        </p>
    </div>
</div>

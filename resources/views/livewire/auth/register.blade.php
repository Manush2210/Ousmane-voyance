<div class="bg-white shadow-md mx-auto mt-10 p-6 rounded-lg max-w-2xl">
    <h2 class="mb-6 font-bold text-gray-800 text-2xl text-center">Créer un compte</h2>

    <form wire:submit.prevent="register" class="space-y-4">
        <div class="flex space-x-6 mb-4">
            <label class="flex items-center space-x-2">
                <input type="radio" wire:model="client_type" value="private" />
                <span>Particulier</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="radio" wire:model="client_type" value="pro" />
                <span>Professionnel</span>
            </label>
        </div>

        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
            <div>
                <label for="first_name" class="block mb-1 font-medium text-gray-700">Prénom</label>
                <input type="text" id="first_name" wire:model="first_name"
                    class="px-4 py-2 border rounded-lg w-full">
                @error('first_name')
                    <span class="text-emerald-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="last_name" class="block mb-1 font-medium text-gray-700">Nom</label>
                <input type="text" id="last_name" wire:model="last_name" class="px-4 py-2 border rounded-lg w-full">
                @error('last_name')
                    <span class="text-emerald-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="name" class="block mb-1 font-medium text-gray-700">Nom d'utilisateur</label>
            <input type="text" id="name" wire:model="name" class="px-4 py-2 border rounded-lg w-full">
            @error('name')
                <span class="text-emerald-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block mb-1 font-medium text-gray-700">Email</label>
            <input type="email" id="email" wire:model="email" class="px-4 py-2 border rounded-lg w-full">
            @error('email')
                <span class="text-emerald-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="phone" class="block mb-1 font-medium text-gray-700">Téléphone</label>
            <input type="text" id="phone" wire:model="phone" class="px-4 py-2 border rounded-lg w-full">
            @error('phone')
                <span class="text-emerald-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="address" class="block mb-1 font-medium text-gray-700">Adresse</label>
            <input type="text" id="address" wire:model="address" class="px-4 py-2 border rounded-lg w-full">
            @error('address')
                <span class="text-emerald-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="gap-4 grid grid-cols-2">
            <div>
                <label for="postal_code" class="block mb-1 font-medium text-gray-700">Code postal</label>
                <input type="text" id="postal_code" wire:model="postal_code"
                    class="px-4 py-2 border rounded-lg w-full">
                @error('postal_code')
                    <span class="text-emerald-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="city" class="block mb-1 font-medium text-gray-700">Ville</label>
                <input type="text" id="city" wire:model="city" class="px-4 py-2 border rounded-lg w-full">
                @error('city')
                    <span class="text-emerald-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="country" class="block mb-1 font-medium text-gray-700">Pays</label>
            <select id="country" wire:model="country" class="px-4 py-2 border rounded-lg w-full">
                <option value="France">France</option>
                <option value="Belgique">Belgique</option>
                <option value="Suisse">Suisse</option>
                <option value="Canada">Canada</option>
            </select>
        </div>

        <div>
            <label for="password" class="block mb-1 font-medium text-gray-700">Mot de passe</label>
            <input type="password" id="password" wire:model="password" class="px-4 py-2 border rounded-lg w-full">
            @error('password')
                <span class="text-emerald-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block mb-1 font-medium text-gray-700">Confirmer le mot de
                passe</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                class="px-4 py-2 border rounded-lg w-full">
        </div>

        <button type="submit"
            class="bg-emerald-600 hover:bg-emerald-300 px-4 py-2 rounded-lg w-full text-white transition duration-200">
            S'inscrire
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-gray-600">
            Déjà inscrit?
            <a href="{{ route('login') }}" class="text-emerald-600 hover:underline">Se connecter</a>
        </p>
    </div>
</div>

<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Créer un compte</h2>

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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="first_name" class="block text-gray-700 font-medium mb-1">Prénom</label>
                <input type="text" id="first_name" wire:model="first_name"
                    class="w-full px-4 py-2 border rounded-lg">
                @error('first_name')
                    <span class="text-purple-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="last_name" class="block text-gray-700 font-medium mb-1">Nom</label>
                <input type="text" id="last_name" wire:model="last_name" class="w-full px-4 py-2 border rounded-lg">
                @error('last_name')
                    <span class="text-purple-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="name" class="block text-gray-700 font-medium mb-1">Nom d'utilisateur</label>
            <input type="text" id="name" wire:model="name" class="w-full px-4 py-2 border rounded-lg">
            @error('name')
                <span class="text-purple-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" id="email" wire:model="email" class="w-full px-4 py-2 border rounded-lg">
            @error('email')
                <span class="text-purple-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-gray-700 font-medium mb-1">Téléphone</label>
            <input type="text" id="phone" wire:model="phone" class="w-full px-4 py-2 border rounded-lg">
            @error('phone')
                <span class="text-purple-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-gray-700 font-medium mb-1">Adresse</label>
            <input type="text" id="address" wire:model="address" class="w-full px-4 py-2 border rounded-lg">
            @error('address')
                <span class="text-purple-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="postal_code" class="block text-gray-700 font-medium mb-1">Code postal</label>
                <input type="text" id="postal_code" wire:model="postal_code"
                    class="w-full px-4 py-2 border rounded-lg">
                @error('postal_code')
                    <span class="text-purple-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="city" class="block text-gray-700 font-medium mb-1">Ville</label>
                <input type="text" id="city" wire:model="city" class="w-full px-4 py-2 border rounded-lg">
                @error('city')
                    <span class="text-purple-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="country" class="block text-gray-700 font-medium mb-1">Pays</label>
            <select id="country" wire:model="country" class="w-full px-4 py-2 border rounded-lg">
                <option value="France">France</option>
                <option value="Belgique">Belgique</option>
                <option value="Suisse">Suisse</option>
                <option value="Canada">Canada</option>
            </select>
        </div>

        <div>
            <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe</label>
            <input type="password" id="password" wire:model="password" class="w-full px-4 py-2 border rounded-lg">
            @error('password')
                <span class="text-purple-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirmer le mot de
                passe</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button type="submit"
            class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-300 transition duration-200">
            S'inscrire
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-gray-600">
            Déjà inscrit?
            <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Se connecter</a>
        </p>
    </div>
</div>

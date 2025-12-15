<div class="p-4 sm:p-6 lg:p-8">
    <div class="bg-white shadow mx-auto p-6 rounded-lg max-w-3xl">
        <h1 class="font-bold text-gray-800 text-2xl">Paramètres du site</h1>
        @if(session('success_message'))
            <div class="bg-green-50 mt-4 p-3 border border-green-200 rounded text-green-800">{{ session('success_message') }}</div>
        @endif

        <form wire:submit.prevent="save" class="space-y-4 mt-6">
            <div>
                <label class="block font-medium text-gray-700 text-sm">Email de contact</label>
                <input wire:model="email" type="email" class="block mt-1 border-gray-200 rounded-md w-full" placeholder="contact@exemple.com">
            </div>

            <div>
                <label class="block font-medium text-gray-700 text-sm">Téléphone de contact</label>
                <input wire:model="contact_phone" type="text" class="block mt-1 border-gray-200 rounded-md w-full" placeholder="+33 6 12 34 56 78">
            </div>

            <div>
                <label class="block font-medium text-gray-700 text-sm">Lien Facebook</label>
                <input wire:model="fb_link" type="url" class="block mt-1 border-gray-200 rounded-md w-full" placeholder="https://facebook.com/yourpage">
            </div>

            <div>
                <label class="block font-medium text-gray-700 text-sm">Lien Instagram</label>
                <input wire:model="insta_link" type="url" class="block mt-1 border-gray-200 rounded-md w-full" placeholder="https://instagram.com/yourprofile">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded-md text-white">Sauvegarder</button>
            </div>
        </form>
    </div>
</div>

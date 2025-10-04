<div>
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="mb-10 text-center">
                <h1 class="font-extrabold text-gray-900 text-3xl sm:text-4xl tracking-tight">
                    Prendre un rendez-vous
                </h1>
                <p class="mx-auto mt-4 max-w-2xl text-gray-600 text-lg">
                    Suivez les étapes pour planifier votre consultation privée en quelques clics.
                </p>
            </div>

            {{-- @dump($account) --}}

            <!-- Conteneur principal de l'assistant -->
            <div class="gap-12 grid grid-cols-1 lg:grid-cols-3">

                <!-- COLONNE DE GAUCHE : Résumé de la réservation -->
                <aside class="lg:col-span-1">
                    <div class="top-24 sticky bg-white shadow-lg p-6 rounded-2xl">
                        <div class="flex items-center gap-4 pb-4 border-b">
                            <img src="{{ asset('assets/images/layout/logo.png') }}" alt="logo" class="rounded-full w-16 h-16">
                            <div>
                                <h2 class="font-bold text-gray-800">Votre réservation</h2>
                                <p class="text-gray-500 text-sm">Résumé de votre sélection</p>
                            </div>
                        </div>

                        <div class="space-y-6 mt-6">
                            <!-- Etape 1 : Consultation -->
                            <div class="flex items-start gap-4">
                                <div @class(['flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full', 'bg-teal-600' => $currentStep >= 1, 'bg-gray-200' => $currentStep < 1])>
                                    @if($this->selectedConsultationDetails)
                                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                    @else
                                        <span @class(['font-bold', 'text-white' => $currentStep >= 1, 'text-gray-500' => $currentStep < 1])>1</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Type de consultation</h3>
                                    @if($this->selectedConsultationDetails)
                                        <p class="text-gray-600 text-sm">{{ $this->selectedConsultationDetails->name }}</p>
                                        <p class="font-bold text-teal-600 text-sm">{{ number_format($this->selectedConsultationDetails->price, 2) }} €</p>
                                        <button wire:click="goToStep(1)" class="text-teal-500 text-xs hover:underline">Modifier</button>
                                    @else
                                        <p class="text-gray-400 text-sm">À sélectionner</p>
                                    @endif
                                </div>
                            </div>

                             <!-- Etape 2 : Date & Heure -->
                            <div class="flex items-start gap-4">
                               <div @class(['flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full', 'bg-teal-600' => $currentStep >= 2, 'bg-gray-200' => $currentStep < 2])>
                                    @if($selectedDate && $this->selectedSlotDetails)
                                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                    @else
                                        <span @class(['font-bold', 'text-white' => $currentStep >= 2, 'text-gray-500' => $currentStep < 2])>2</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Date et heure</h3>
                                    @if($selectedDate && $this->selectedSlotDetails)
                                        <p class="text-gray-600 text-sm">
                                            {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}
                                            à {{ \Carbon\Carbon::parse($this->selectedSlotDetails->start_time)->format('H:i') }}
                                        </p>
                                        <button wire:click="goToStep(2)" class="text-teal-500 text-xs hover:underline">Modifier</button>
                                    @else
                                        <p class="text-gray-400 text-sm">À sélectionner</p>
                                    @endif
                                </div>
                            </div>

                             <!-- Etape 3 : Informations -->
                            <div class="flex items-start gap-4">
                                <div @class(['flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full', 'bg-teal-600' => $currentStep >= 3, 'bg-gray-200' => $currentStep < 3])>
                                    <span @class(['font-bold', 'text-white' => $currentStep >= 3, 'text-gray-500' => $currentStep < 3])>3</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Vos informations</h3>
                                    <p class="text-gray-400 text-sm">À compléter</p>
                                </div>
                            </div>
                        </div>

                        <!-- Informations Bancaires -->
                        @if($currentStep === 3 && $account)
                        <div class="mt-6 pt-6 border-t">
                             <h3 class="mb-2 font-semibold text-gray-800">Informations de paiement</h3>
                             <div class="space-y-2 bg-gray-100 p-4 rounded-lg text-sm">
                                <p><strong class="text-gray-600">Banque:</strong> {{ $account->bank }}</p>
                                <p><strong class="text-gray-600">Titulaire du compte:</strong> {{ $account->owner }}</p>
                                <p><strong class="text-gray-600">IBAN:</strong> {{ $account->iban }}</p>
                                <p><strong class="text-gray-600">BIC/SWIFT:</strong> {{ $account->swift }}</p>
                                <p><strong class="text-gray-600">Pays:</strong> {{ $account->country }}</p>
                                <p class="mt-2 text-gray-500 text-xs">Veuillez effectuer le virement et joindre la preuve de paiement à l'étape suivante.</p>
                             </div>
                        </div>
                        @endif
                    </div>
                </aside>

                <!-- COLONNE DE DROITE : Étapes -->
                <main class="lg:col-span-2">
                    <div class="bg-white shadow-lg p-8 rounded-2xl min-h-[600px]">

                        <!-- ÉTAPE 1: CHOIX DE LA CONSULTATION -->
                        <div x-show="$wire.currentStep === 1" x-transition.opacity>
                           <h2 class="font-bold text-gray-900 text-2xl">1. Choisissez votre consultation</h2>
                            <div class="space-y-4 mt-6">
                                @forelse ($consultationTypes as $type)
                                    <button wire:click="selectConsultationType({{ $type->id }})" class="hover:bg-teal-50 p-4 border hover:border-teal-500 rounded-lg w-full text-left transition-all">
                                        <div class="flex justify-between items-center">
                                            <h3 class="font-semibold text-gray-800">{{ $type->name }}</h3>
                                            <span class="font-bold text-teal-600">{{ number_format($type->price, 2) }} €</span>
                                        </div>
                                        <p class="mt-1 text-gray-500 text-sm">{{ $type->description }}</p>
                                    </button>
                                @empty
                                    <p class="text-gray-500">Aucun type de consultation disponible.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- ÉTAPE 2: CHOIX DE LA DATE ET DE L'HEURE -->
                        <div x-show="$wire.currentStep === 2" x-transition.opacity>
                            <h2 class="font-bold text-gray-900 text-2xl">2. Sélectionnez une date et une heure</h2>
                            <div class="gap-8 grid grid-cols-1 md:grid-cols-2 mt-6">
                                <!-- Calendrier -->
                                <div>
                                    <div class="flex justify-between items-center mb-4">
                                        <button wire:click="prevMonth" type="button" class="hover:bg-gray-100 p-2 rounded-full">&larr;</button>
                                        <h3 class="font-semibold">{{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->translatedFormat('F Y') }}</h3>
                                        <button wire:click="nextMonth" type="button" class="hover:bg-gray-100 p-2 rounded-full">&rarr;</button>
                                    </div>
                                    <div class="grid grid-cols-7 mb-2 text-gray-500 text-sm text-center">
                                        <span>Lun</span><span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
                                    </div>
                                    <div class="gap-1 grid grid-cols-7">
                                        {{-- @dump($calendarDays) --}}
                                        @foreach ($calendarDays as $day)
                                            <div wire:click="{{ $day['date'] && !$day['isPast'] && !$day['isBooked'] ? 'selectDate(\'' . $day['date'] . '\')' : '' }}"
                                                class="aspect-square flex items-center justify-center border rounded-lg {{ $day['isToday'] ? 'bg-teal-100 border-teal-400' : '' }} {{ $selectedDate === $day['date'] ? 'bg-teal-500 text-white' : '' }} {{ $day['isPast'] || $day['isBooked'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-teal-100 cursor-pointer' }} {{ !$day['date'] ? 'border-transparent' : '' }}">
                                                @if ($day['day'])
                                                    <span>{{ $day['day'] }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Créneaux horaires -->
                                <div class="max-h-80 overflow-y-auto">
                                    @if($selectedDate)
                                        <h3 class="mb-2 font-semibold">Créneaux pour le {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d MMMM') }}</h3>
                                        @if(count($availableTimeSlots) > 0)
                                        <div class="space-y-2">
                                            @foreach($availableTimeSlots as $slot)
                                                <button wire:click="selectTimeSlot({{ $slot['id'] }})" type="button" class="hover:bg-teal-50 p-3 border hover:border-teal-500 rounded-lg w-full font-semibold text-teal-600 text-center transition-all">
                                                    {{ \Carbon\Carbon::parse($slot['start_time'])->format('H:i') }}
                                                </button>
                                            @endforeach
                                        </div>
                                        @else
                                            <p class="bg-gray-50 p-4 rounded-lg text-gray-500 text-sm text-center">Aucun créneau disponible pour cette date.</p>
                                        @endif
                                    @else
                                        <p class="bg-gray-50 p-4 rounded-lg text-gray-500 text-sm text-center">Veuillez sélectionner une date pour voir les créneaux.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- ÉTAPE 3: VOS INFORMATIONS -->
                        <div x-show="$wire.currentStep === 3" x-transition.opacity>
                            <h2 class="font-bold text-gray-900 text-2xl">3. Vos informations</h2>
                             <form wire:submit="bookAppointment" class="space-y-4 mt-6">
                                 <!-- Form fields here, simplified for brevity -->
                                 <input wire:model="clientName" type="text" placeholder="Nom complet*" class="rounded-md w-full" required>
                                 <input wire:model="clientEmail" type="email" placeholder="Adresse e-mail*" class="rounded-md w-full" required>
                                 <input wire:model="clientPhone" type="tel" placeholder="Téléphone (avec indicatif pays)*" class="rounded-md w-full" required>
                                 <select wire:model="contactMethod" class="rounded-md w-full" required>
                                     <option value="">Méthode de contact préférée*</option>
                                     <option value="email">Email</option>
                                     <option value="whatsapp">WhatsApp</option>
                                     {{-- <option value="telephone">Téléphone</option> --}}
                                 </select>
                                 <textarea wire:model="notes" placeholder="Notes (optionnel)" class="rounded-md w-full" rows="3"></textarea>

                                 <div>
                                     <label class="block font-medium text-gray-700 text-sm">Preuve de paiement <span class="text-gray-500 text-sm">(optionnel)</span></label>
                                     <input type="file" wire:model="paymentProof" class="block hover:file:bg-teal-100 file:bg-teal-50 mt-1 file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-500 file:text-teal-700 text-sm file:text-sm">
                                     <p class="mt-1 text-gray-500 text-sm">Le paiement peut être effectué lors du contact ; si vous préférez payer plus tard, laissez ce champ vide et indiquez votre préférence dans la méthode de contact.</p>
                                     @error('paymentProof') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                 </div>

                                <div wire:ignore class="pt-2">
                                    <div class="cf-turnstile" data-sitekey="{{ config('services.cloudflare.site_key') }}" data-callback="onTurnstileSuccess" data-size="normal"></div>
                                </div>
                                @error('turnstileToken') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                <div class="flex justify-between items-center pt-4">
                                    <button type="button" wire:click="goToStep(2)" class="font-semibold text-gray-600 hover:text-gray-800 text-sm">
                                        &larr; Retour
                                    </button>
                                     <button type="submit" class="inline-flex justify-center bg-teal-600 hover:bg-teal-700 shadow-sm px-6 py-3 rounded-lg font-semibold text-white text-base" wire:loading.attr="disabled">
                                         <span wire:loading.remove>Confirmer le rendez-vous</span>
                                         <span wire:loading>Confirmation...</span>
                                     </button>
                                </div>
                             </form>
                        </div>

                        <!-- ÉTAPE 4: CONFIRMATION -->
                        <div x-show="$wire.currentStep === 4" x-transition.opacity class="py-16 text-center">
                             <div class="flex justify-center items-center bg-green-100 mx-auto rounded-full w-16 h-16">
                                 <svg class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                             </div>
                             <h2 class="mt-6 font-bold text-gray-900 text-2xl">Rendez-vous confirmé !</h2>
                             <p class="mt-4 text-gray-600">
                                 Merci, {{ $clientName }}. Votre rendez-vous a été réservé avec succès.
                                 Un e-mail de confirmation contenant tous les détails vous a été envoyé.
                             </p>
                             <a href="/" class="inline-block bg-teal-600 hover:bg-teal-700 mt-8 px-5 py-3 rounded-md font-medium text-white text-base">
                                 Retour à l'accueil
                             </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <!-- Script pour Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script>
        function onTurnstileSuccess(token) {
            if (token) {
                @this.set('turnstileToken', token);
            }
        }
    </script>
@endpush

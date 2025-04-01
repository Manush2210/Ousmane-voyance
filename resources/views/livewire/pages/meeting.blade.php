<div>
    <section>
        <div class=" container">
            <div class="my-4 font-[Poly] ">
                <h1 class="text-4xl font-bold text-gray-500">Rendez-vous</h1>
            </div>
            <p class="text-xl mb-6 font-bold text-gray-400">
                Je vous souhaite la bienvenue, j'aurai le plaisir de répondre à toutes vos questions concernant l'amour,
                le travail, l'argent ... lors de votre consultation privée que vous pouvez réserver via le calendrier
                ci-dessous. Grâce à la guidance réalisée avec des cartes divinatoires (oracle), je vous apporte mon aide
                afin d'orienter votre vie vers la meilleure direction en vous apportant des réponses à vos questions.
            </p>

            <div class="meeting-form  mx-auto border-2 rounded-lg border-gray-300 ">
                <div class="flex border-b-2 p-6 border-b-gray-200 flex-col gap-4 w-full">
                    <img src="{{ asset('assets/images/layout/logo.webp') }}" alt="logo" class="mx-auto h-20 w-20">
                </div>
                <div class="flex border-b-2 p-6 border-b-gray-200 flex-col gap-4 w-full">
                    <img src="{{ asset('assets/images/layout/logo.webp') }}" alt="logo"
                        class="mx-auto rounded-full h-20 w-20">
                    <div class="text-center space-y-4">
                        <h4 class="text-lg text-gray-400 font-bold">Voyance et Bienveillance</h4>
                        <h1 class="font-bold text-3xl text-slate-700">Consultation privée</h1>
                        <div class="flex justify-center space-x-4 my-3 gap-4 text-gray-400">
                            <div class="flex items-center text-gray-400 gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-semibold mt-1">1h </span>
                            </div>
                            <div class="flex items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>


                                <span class="text-sm font-semibold mt-1">Téléphone</span>
                            </div>
                            <div class="flex text-gray-400 gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                <span class="text-sm font-semibold mt-1">{{$account->appointment_pricing}} €</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="meeting-scheduler">
                    <div class="flex flex-col gap-4 p-6">
                        <div class="text-center">
                            <h1 class="text-xl font-bold text-slate-700">Sélectionnez la date et l'heure
                            </h1>
                            <p class="text-lg text-gray-400">Sélectionnez une date et une heure qui vous conviennent.
                            </p>

                        </div>
                        <div class="flex justify-center">
                            <div class="w-full max-w-sm">
                                <!-- Calendrier -->
                                <div class="mb-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <button wire:click="prevMonth"
                                            class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <h2 class="text-xl font-semibold">
                                            {{ \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->locale('fr')->monthName }}
                                            {{ $currentYear }}</h2>
                                        <button wire:click="nextMonth"
                                            class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Jours de la semaine -->
                                    <div class="grid grid-cols-7 gap-1 mb-2">
                                        <div class="text-center font-medium text-gray-500">Lun</div>
                                        <div class="text-center font-medium text-gray-500">Mar</div>
                                        <div class="text-center font-medium text-gray-500">Mer</div>
                                        <div class="text-center font-medium text-gray-500">Jeu</div>
                                        <div class="text-center font-medium text-gray-500">Ven</div>
                                        <div class="text-center font-medium text-gray-500">Sam</div>
                                        <div class="text-center font-medium text-gray-500">Dim</div>
                                    </div>

                                    <!-- Jours du mois -->
                                    <div class="grid grid-cols-7 gap-1">
                                        @foreach ($calendarDays as $day)
                                            <div wire:click="{{ $day['date'] && !$day['isPast'] && !$day['isBooked'] ? 'selectDate(\'' . $day['date'] . '\')' : '' }}"
                                                class="aspect-square flex items-center justify-center border rounded-lg {{ $day['isToday'] ? 'bg-indigo-100 border-indigo-400' : '' }} {{ $selectedDate === $day['date'] ? 'bg-indigo-500 text-white' : '' }} {{ $day['isPast'] || $day['isBooked'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-indigo-100 cursor-pointer' }} {{ !$day['date'] ? 'border-transparent' : '' }}">
                                                @if ($day['day'])
                                                    <span>{{ $day['day'] }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- @dump($selectedDate) --}}
                                <!-- Créneaux horaires -->
                                @if ($selectedDate)
                                    <div class="mb-6">
                                        <h3 class="text-xl font-semibold mb-4">Créneaux disponibles pour le
                                            {{ \Carbon\Carbon::parse($selectedDate)->locale('fr')->isoFormat('LL') }}
                                        </h3>

                                        @if (count($availableTimeSlots) > 0)
                                            <div class="grid grid-cols-3 gap-2 md:grid-cols-4">
                                                @foreach ($availableTimeSlots as $slot)
                                                    <button wire:click="selectTimeSlot({{ $slot['id'] }})"
                                                        class="py-2 px-4 border rounded-lg {{ $selectedTimeSlot == $slot['id'] ? 'bg-indigo-500 text-white' : 'hover:bg-indigo-100' }}">
                                                        {{ \Carbon\Carbon::parse($slot['start_time'])->format('H:i') }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-gray-500">Aucun créneau disponible pour cette date.</p>
                                        @endif
                                    </div>
                                @endif

                                <!-- Formulaire de réservation -->
                                @if ($selectedTimeSlot)
                                    <div class="border rounded-lg p-6">

                                        <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                            <h4 class="font-semibold text-lg mb-3 text-gray-700">Informations bancaires
                                                pour le paiement</h4>
                                            <div class="space-y-2">
                                                @if ($account != null)
                                                    <div class="flex">
                                                        <span class="w-20 font-medium text-gray-500">Nom:</span>
                                                        <span
                                                            class="text-slate-700 uppercase">{{ $account->owner }}</span>
                                                    </div>
                                                    <div class="flex">
                                                        <span class="w-20 font-medium text-gray-500">IBAN:</span>
                                                        <span
                                                            class="text-slate-700 font-mono uppercase">{{ $account->iban }}</span>
                                                    </div>
                                                    <div class="flex">
                                                        <span class="w-20 font-medium text-gray-500">SWIFT:</span>
                                                        <span
                                                            class="text-slate-700 font-mono uppercase">{{ $account->swift }}</span>
                                                    </div>
                                                @else
                                                    <div class="flex">
                                                        <span class="w-20 font-medium text-gray-500">Banque:</span>
                                                        <span class="text-slate-700 uppercase">Non disponible contactez
                                                            nous</span>
                                                    </div>
                                                @endif

                                            </div>
                                            <p class="mt-3 text-sm text-gray-500">Veuillez effectuer votre paiement à
                                                ce compte et télécharger la preuve de paiement ci-dessous.</p>
                                        </div>
                                        <h3 class="text-xl font-semibold mb-4">Vos informations</h3>

                                        @if (session()->has('message'))
                                            <div
                                                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                                {{ session('message') }}
                                            </div>
                                        @endif

                                        <form wire:submit.prevent="bookAppointment" class="space-y-4">
                                            <div>
                                                <label for="contactMethod" class="block text-gray-700">Méthode de
                                                    contact</label>
                                                <select id="contactMethod" wire:model="contactMethod"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">-- Sélectionnez une méthode --</option>
                                                    <option value="email">Email</option>
                                                    <option value="whatsapp">WhatsApp</option>
                                                </select>
                                                @error('contactMethod')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="clientName" class="block text-gray-700">Nom
                                                    complet</label>
                                                <input type="text" id="clientName" wire:model="clientName"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('clientName')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="clientEmail" class="block text-gray-700">Email</label>
                                                <input type="email" id="clientEmail" wire:model="clientEmail"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('clientEmail')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="clientPhone" class="block text-gray-700">Téléphone</label>
                                                <p class="mt-1 text-xs text-red-800">Veuillez inclure l'indicatif pays
                                                    (ex: +33 pour la France)</p>

                                                <input type="tel" id="clientPhone" wire:model="clientPhone"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('clientPhone')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="payment_proof" class="block text-gray-700">Preuve de
                                                    paiement</label>
                                                <div x-data="{ fileName: '' }" class="mt-1 flex items-center">
                                                    <input type="file" id="payment_proof"
                                                        wire:model="paymentProof" class="hidden"
                                                        x-on:change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                                    <label for="payment_proof"
                                                        class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                                        Choisir un fichier
                                                    </label>
                                                    <span x-text="fileName" class="ml-2 text-gray-600 text-sm"></span>
                                                </div>
                                                @error('paymentProof')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="notes" class="block text-gray-700">Notes
                                                    (optionnel)</label>
                                                <textarea id="notes" wire:model="notes" rows="3"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                            </div>

                                            <div class="pt-4">
                                                <button type="submit"
                                                    class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Confirmer le rendez-vous
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <p class="text-xl  text-gray-400">
                La cartomancie peut être un outil intéressant pour la réflexion, mais il est essentiel de ne pas en
                abuser; chacun est responsable de ses choix et de sa vie, et il faut veiller à ne pas laisser les cartes
                guider chaque aspect de notre existence. La véritable sagesse réside dans notre capacité à vivre
                pleinement et à prendre nos propres décisions.


            </p>
        </div>
    </section>

</div>

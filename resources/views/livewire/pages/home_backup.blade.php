<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    @livewire('components.heros')

    {{-- @dump(auth()->user()) --}}

    <section class="bg-white py-20">
        <div class="mx-auto container">

            <div class="mb-12 text-center">
                <h2 class="font-extrabold text-gray-800 text-4xl sm:text-5xl">
                    Une Expérience de Guidance Intuitive et Personnalisée
                </h2>
                <p class="mx-auto mt-4 max-w-2xl text-gray-600 text-xl">
                    Découvrez une plateforme conçue pour vous accompagner sur votre chemin de vie.
                </p>
            </div>

            <div class="items-center gap-12 grid grid-cols-1 md:grid-cols-2">
                <!-- Colonne de l'image -->
                <div class="shadow-2xl rounded-lg overflow-hidden">
                    <img src="{{ asset('assets/images/digi-v.jpg') }}" alt="Le monde d'Auxane Voyance"
                        class="w-full h-auto object-center object-cover hover:scale-105 transition-transform duration-500 ease-in-out transform">
                </div>

                <!-- Colonne des fonctionnalités -->
                <div class="space-y-8">
                    <div>
                        <h3 class="mb-4 font-bold text-emerald-700 text-2xl">Ce que notre plateforme vous réserve :</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Nous avons créé un espace sécurisé et bienveillant pour vous offrir des outils de guidance
                            clairs et des ressources exclusives. Naviguez avec simplicité et trouvez les réponses que
                            vous cherchez.
                        </p>
                    </div>

                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <span
                                    class="flex justify-center items-center bg-emerald-100 rounded-full w-12 h-12 text-emerald-600">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800 text-lg">Guidance Personnalisée</h4>
                                <p class="mt-1 text-gray-600">Bénéficiez de conseils sur-mesure et de consultations
                                    adaptées à votre situation unique grâce à nos outils interactifs.</p>
                            </div>
                        </li>

                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <span
                                    class="flex justify-center items-center bg-emerald-100 rounded-full w-12 h-12 text-emerald-600">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.33 11.162A3.001 3.001 0 016.5 6h11a3.001 3.001 0 012.168 5.162l-6.67 7.623A3 3 0 016.5 18H5a2 2 0 01-2-2v-2.5a3 3 0 01.33-1.338z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800 text-lg">Tirages de Cartes en Ligne</h4>
                                <p class="mt-1 text-gray-600">Accédez à tout moment à des tirages de cartes interactifs
                                    pour obtenir des éclaircissements immédiats.</p>
                            </div>
                        </li>



                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <span
                                    class="flex justify-center items-center bg-emerald-100 rounded-full w-12 h-12 text-emerald-600">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.523 5.754 19 7.5 19s3.332-.477 4.5-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.523 18.246 19 16.5 19c-1.746 0-3.332-.477-4.5-1.253" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800 text-lg">Ressources et Articles</h4>
                                <p class="mt-1 text-gray-600">Approfondissez vos connaissances avec notre bibliothèque
                                    d'articles, de conseils et de ressources exclusives.</p>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-10">
                        <a href="{{ route('meeting') }}"
                            class="inline-block inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 shadow-lg px-8 py-3 rounded-lg font-bold text-white transition-all hover:-translate-y-1 duration-300 transform">
                            <svg class="w-5 h-5 text-white animate-bounce" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Vivre l'expérience.
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Section Types de consultation -->
    <section class="bg-white py-16">
        <div class="mx-auto container">
            <div class="mb-8 text-center">
                <h2 class="font-extrabold text-gray-800 text-3xl">Types de consultation</h2>
                <p class="mt-2 text-gray-600">Choisissez le type de séance qui vous convient</p>
            </div>

            @if (!empty($consultationTypes) && $consultationTypes->isNotEmpty())
                <div class="gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($consultationTypes as $type)
                        <div class="shadow hover:shadow-lg p-6 border rounded-lg transition">
                            @if ($type->image)
                                <div class="mb-4 rounded w-full h-44 overflow-hidden">
                                    <img src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif
                            <h3 class="font-semibold text-gray-800 text-xl">{{ $type->name }}</h3>
                            <p class="mt-2 text-gray-600">{{ Str::limit($type->description, 120) }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <div class="font-bold text-emerald-700 text-lg">
                                    {{ number_format($type->price, 2, ',', ' ') }} €</div>
                                <a href="{{ route('meeting') }}?type={{ $type->id }}"
                                    class="bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded text-white">Réserver</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center">Aucun type de consultation disponible pour le moment.</p>
            @endif
        </div>
    </section>

    <!-- Section Derniers Produits -->
    <section class="bg-white py-16">
        <div class="mx-auto container">
            <div class="mb-8 text-center">
                <h2 class="font-extrabold text-gray-800 text-3xl">Derniers produits</h2>
                <p class="mt-2 text-gray-600">Découvrez nos dernières nouveautés</p>
            </div>

            @if (!empty($products) && $products->isNotEmpty())
                <div class="gap-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
                    @foreach ($products as $item)
                        @livewire(
                            'components.product.product-card',
                            [
                                'images' => $item->images,
                                'title' => $item->name,
                                'price' => $item->price,
                                'slug' => $item->slug,
                                'product' => $item,
                            ],
                            key( $item->id )
                        )
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center">Aucun produit pour le moment.</p>
            @endif
        </div>
    </section>




    <section class="bg-slate-50 py-16 sm:py-24 about">
        <div class="mx-auto px-4 max-w-5xl container">

            <!-- Titre de la section -->
            <div class="mb-12 text-center">
                <h2 class="font-extrabold text-gray-900 text-3xl sm:text-4xl">
                    Ma Vocation : Vous Éclairer sur Votre Chemin de Vie
                </h2>
                <p class="mx-auto mt-4 max-w-2xl text-gray-600 text-lg">
                    Découvrez une approche de la voyance fondée sur l'écoute, le respect et la bienveillance.
                </p>
            </div>

            <div class="items-center gap-12 grid grid-cols-1 lg:grid-cols-5">

                <!-- Colonne Image (Très important pour la confiance) -->
                <div class="lg:col-span-2">
                    <div class="shadow-2xl rounded-xl aspect-[4/5] overflow-hidden">
                        <!-- Remplacez par une photo professionnelle de vous-même -->
                        <img class="w-full h-full object-center object-cover"
                            src="{{asset('assets/images/bougie.jpg')}}"
                            alt="Portrait de votre nom, voyant et guide spirituel">
                    </div>
                </div>

                <!-- Colonne Contenu -->
                <div class="lg:col-span-3">
                    <div class="space-y-8">
                        <div>
                            <h3 class="mb-3 font-bold text-emerald-700 text-2xl">Qui suis-je ?</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Passionné par les arts divinatoires et le développement personnel, j'ai consacré ma vie
                                à affiner mon don de clairvoyance pour offrir des guidances claires et utiles. Mon
                                objectif n'est pas de prédire un futur immuable, mais de vous donner les clés pour
                                comprendre votre présent et construire l'avenir qui vous correspond.
                            </p>
                        </div>

                        <!-- Ma Mission -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <span
                                    class="flex justify-center items-center bg-emerald-100 rounded-full w-12 h-12 text-emerald-600">
                                    <!-- Icône pour la mission/vision -->
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639l7.5-10.5a.5.5 0 01.832.664l-6.5 9.152 6.5 9.152a.5.5 0 01-.832.664l-7.5-10.5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12.036 12.322a1.012 1.012 0 010-.639l7.5-10.5a.5.5 0 01.832.664l-6.5 9.152 6.5 9.152a.5.5 0 01-.832.664l-7.5-10.5z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800 text-lg">Ma Mission</h4>
                                <p class="mt-1 text-gray-600">Vous accompagner dans la clarté et la confiance, en
                                    illuminant les zones d'ombre et en révélant votre potentiel pour vous aider à
                                    prendre des décisions éclairées.</p>
                            </div>
                        </div>

                        <!-- Mon Éthique -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <span
                                    class="flex justify-center items-center bg-emerald-100 rounded-full w-12 h-12 text-emerald-600">
                                    <!-- Icône pour l'éthique/confiance -->
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm0 13.036h.008v.008h-.008v-.008z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800 text-lg">Mon Éthique</h4>
                                <p class="mt-1 text-gray-600">Chaque consultation est un échange confidentiel, mené
                                    sans jugement. Je m'engage à une totale honnêteté, y compris sur les limites de ma
                                    pratique, et je ne pratique aucune forme de complaisance.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Citation inspirante -->
                    <div class="mt-10 pl-4 border-emerald-500 border-l-4">
                        <p class="text-gray-600 italic">
                            "Mon plus grand souhait est que vous repartiez de notre séance avec plus de sérénité et de
                            force pour avancer."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-16 testimonies">
        <div class="mx-auto container">
            <h2 class="mb-12 font-semibold text-gray-800 text-4xl text-center">Ce que disent nos clients</h2>
            <div class="gap-8 grid md:grid-cols-2 lg:grid-cols-4">
                {{-- Témoignage de Marie --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">M</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Les oracles de bienveillance et d'amour m'accompagnent chaque jour.
                        Ils m'aident à trouver de la clarté"</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Marie</span>
                    </div>
                </div>

                {{-- Témoignage de Christelle --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">C</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Chaque tirage est une occasion d'en apprendre davantage sur moi-même
                        et de trouver un équilibre"</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Christelle</span>
                    </div>
                </div>

                {{-- Témoignage de Franck --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">F</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Franchement, tirer une carte, ça m'aide à y voir plus clair et à
                        prendre du recul sur pas mal de choses."</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Franck</span>
                    </div>
                </div>

                {{-- Témoignage de Mélissa --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">M</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Génial ! Livraison rapide !"</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Mélissa</span>
                    </div>
                </div>
                {{-- Témoignage de Sophie --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">S</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Une expérience transformatrice ! Les conseils sont justes et m'aident vraiment dans ma vie quotidienne."</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Sophie</span>
                    </div>
                </div>

                {{-- Témoignage de Laurent --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">L</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"J'étais sceptique au début, mais les tirages sont vraiment pertinents. Ça m'aide à mieux comprendre mes émotions."</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Laurent</span>
                    </div>
                </div>

                {{-- Témoignage d'Isabelle --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">I</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Un accompagnement bienveillant et professionnel. Les consultations m'apportent la sérénité dont j'avais besoin."</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Isabelle</span>
                    </div>
                </div>

                {{-- Témoignage de Thomas --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">T</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Les outils proposés sont excellents. J'utilise régulièrement les tirages en ligne, c'est très pratique."</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Thomas</span>
                    </div>
                </div>

                {{-- Témoignage d'Amélie --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">A</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Une approche respectueuse et éclairante. Chaque séance m'apporte de nouvelles perspectives sur ma vie."</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">Amélie</span>
                    </div>
                </div>

                {{-- Témoignage de David --}}
                <div class="bg-white shadow-lg p-6 rounded-lg hover:scale-105 transition duration-300 transform">
                    <div class="flex justify-center mb-4">
                        <div class="flex justify-center items-center bg-emerald-500 rounded-full w-12 h-12">
                            <span class="font-bold text-white text-xl">D</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">"Service de qualité avec des produits authentiques. Je recommande vivement cette plateforme."</p>
                    <div class="flex justify-center items-center">
                        <span class="font-medium text-emerald-500">David</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

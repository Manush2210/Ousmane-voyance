<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <header class="container">
        @livewire('components.carousel.carousel')
        <div class="relative py-20 mx-auto text-center max-w-5xl">
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <div class="w-8 h-1 bg-purple-400 rounded-full animate-pulse"></div>
                <div class="w-8 h-1 bg-purple-600 rounded-full animate-pulse delay-75"></div>
                <div class="w-8 h-1 bg-purple-800 rounded-full animate-pulse delay-150"></div>
            </div>

            <h2 class="font-['Playfair_Display']">
                <span class="text-3xl font-light tracking-wider text-gray-700">Prenez le contrôle de</span>
                <span
                    class="block mt-6 text-6xl md:text-7xl font-bold bg-gradient-to-r from-purple-700 via-purple-500 to-purple-300 bg-clip-text text-transparent drop-shadow-sm transform hover:scale-105 transition-transform duration-500">
                    Votre Destinée
                </span>
            </h2>

            <div class="mt-12 grid gap-8">
                <div
                    class="backdrop-blur-sm bg-white/50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div
                        class="absolute -left-3 top-0 w-1 h-full bg-gradient-to-b from-purple-600 to-purple-300 rounded-full">
                    </div>
                    <p class="text-gray-700 text-xl leading-relaxed mx-auto max-w-3xl">
                        Explorez un monde de <span class="font-medium text-purple-600">sagesse ancestrale</span> et de
                        <span class="font-medium text-purple-600">découverte personnelle</span> à travers notre
                        collection
                        soigneusement sélectionnée. Nous vous proposons des Oracles authentiques, des Porte-Bonheur
                        énergétiques et des pierres de lithothérapie aux propriétés exceptionnelles.
                    </p>
                </div>

                <div
                    class="backdrop-blur-sm bg-white/50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 text-xl leading-relaxed mx-auto max-w-3xl">
                        Chaque article est choisi pour vous accompagner vers :
                        <span class="block mt-4 space-y-2">
                            <span
                                class="inline-block font-medium text-purple-600 hover:text-purple-700 transition-colors duration-300 mr-2">✧
                                L'équilibre intérieur</span>
                            <span
                                class="inline-block font-medium text-purple-600 hover:text-purple-700 transition-colors duration-300 mr-2">✧
                                La clarté spirituelle</span>
                            <span
                                class="inline-block font-medium text-purple-600 hover:text-purple-700 transition-colors duration-300">✧
                                L'harmonie quotidienne</span>
                        </span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Quick access button to shop, contact and meeting page on mobile --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8 md:hidden">
            <a href="{{ route('shop') }}"
                class="bg-purple-500 text-white px-3 py-2 text-sm rounded-md hover:bg-purple-600 transition duration-300">Boutique</a>

            <a href="{{ route('contact') }}"
                class="bg-purple-500 text-white px-3 py-2 text-sm rounded-md hover:bg-purple-600 transition duration-300">Contact</a>

            <a href="{{ route('meeting') }}"
                class="bg-purple-500 text-white px-3 py-2 text-sm rounded-md hover:bg-purple-600 transition duration-300">Rendez-vous</a>

            @auth
                <a href="{{ route('order-history') }}"
                    class="bg-purple-500 text-white px-3 py-2 text-sm rounded-md hover:bg-purple-600 transition duration-300">Commandes</a>
            @endauth
        </div>
    </header>

    {{-- @dump(auth()->user()) --}}

    <section class="best-seller bg-gray-100 py-16">

        <div class="container text-center mx-auto">
            <h2 class="text-4xl mb-10 text-gray-600  font-semibold  font-['Dancing_Script']">Meilleures ventes

            </h2>
            @if ($products->isNotEmpty())

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-0">


                    @foreach ($products as $item)
                        {{-- @dump($item) --}}
                        @livewire(
                            'components.product.product-card',
                            [
                                'images' => $item->images,
                                'title' => $item->name,
                                'price' => $item->price,
                                'slug' => $item->slug,
                            ],
                            key($item->id)
                        )
                    @endforeach
                </div>
                <div class="flex justify-center mt-6">

                    <a href="{{ route('shop') }}"
                        class="bg-purple-500 inline-block  my-8 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition duration-300">Voir
                        la Boutique</a>

                </div>
            @endif


            @if ($products->isEmpty())
                <div class="text-center py-8">
                    <h3 class="text-sm text-gray-600">Aucun produit</h3>
                    <p class="text-gray-500">Nous n'avons pas trouvé de produits correspondant à votre recherche.</p>
                </div>
            @endif
        </div>




    </section>

    {{-- ============================================================== --}}
    {{-- Section Témoignages                                            --}}
    {{-- ============================================================== --}}
    <section class="testimonies bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl text-center font-semibold text-gray-800 mb-12">Ce que disent nos clients</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Témoignage de Marie --}}
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl font-bold">M</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Les oracles de bienveillance et d'amour m'accompagnent chaque jour.
                        Ils m'aident à trouver de la clarté"</p>
                    <div class="flex items-center justify-center">
                        <span class="text-purple-500 font-medium">Marie</span>
                    </div>
                </div>

                {{-- Témoignage de Christelle --}}
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl font-bold">C</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Chaque tirage est une occasion d'en apprendre davantage sur moi-même
                        et de trouver un équilibre"</p>
                    <div class="flex items-center justify-center">
                        <span class="text-purple-500 font-medium">Christelle</span>
                    </div>
                </div>

                {{-- Témoignage de Franck --}}
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl font-bold">F</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Franchement, tirer une carte, ça m'aide à y voir plus clair et à
                        prendre du recul sur pas mal de choses."</p>
                    <div class="flex items-center justify-center">
                        <span class="text-purple-500 font-medium">Franck</span>
                    </div>
                </div>

                {{-- Témoignage de Mélissa --}}
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl font-bold">M</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Génial ! Livraison rapide !"</p>
                    <div class="flex items-center justify-center">
                        <span class="text-purple-500 font-medium">Mélissa</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about mb-5 bg-white">
        <div class="container max-w-4xl mx-auto py-12 px-4">
            <div class="text-center mb-8">
                <h2 class="text-4xl font-semibold text-gray-800">Qui suis-je?</h2>
                <div class="w-24 h-1 bg-purple-500 mx-auto mt-4"></div>
            </div>

            <div class="grid gap-8 md:grid-cols-2">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">Mon Don</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Grâce à ma clairvoyance, je peux identifier les bons numéros du loto ainsi que le site où vous
                        aurez le plus de chances de gagner. La voyance est un atout précieux pour prédire les tirages.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">Mon Éthique</h3>
                    <p class="text-gray-600 leading-relaxed">
                        La datation précise d'un événement reste un défi pour tout voyant. Si un clairvoyant est en
                        mesure de le faire, il agit selon son éthique. Lors de la consultation, je vous révélerai les
                        numéros gagnants ainsi que la plateforme idéale pour jouer.
                    </p>
                </div>
            </div>

            <div class="text-center mt-8">
                <p class="text-gray-500 italic">
                    "En retour, après votre gain, vous respecterez votre engagement."
                </p>
            </div>
        </div>
    </section>


</div>

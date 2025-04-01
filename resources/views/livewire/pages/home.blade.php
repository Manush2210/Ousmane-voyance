<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <header class="container">
        @livewire('components.carousel.carousel')
        <div class="py-12 mx-auto text-center">
            <h2 class="text-4xl mb-3 text-red-500 italic font-semibold underline font-['Playfair_Display']">
                Bienvenue
                chez
                VOYANCE ET BIENVEILLANCE
            </h2>
            <p class="text-gray-500 text-lg">
                Bienvenue dans mon monde ! Découvrez mes Oracles, Porte-Bonheur et articles de lithothérapie,
                spécialement créés pour vous apporter harmonie, guidance et bien-être au quotidien.
            </p>
        </div>

        {{-- Quick access button to shop, contact and meeting page on mobile --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8 md:hidden">
            <a href="{{ route('shop') }}"
                class="bg-red-500 text-white px-3 py-2 text-sm rounded-md hover:bg-red-600 transition duration-300">Boutique</a>

            <a href="{{ route('contact') }}"
                class="bg-red-500 text-white px-3 py-2 text-sm rounded-md hover:bg-red-600 transition duration-300">Contact</a>

            <a href="{{ route('meeting') }}"
                class="bg-red-500 text-white px-3 py-2 text-sm rounded-md hover:bg-red-600 transition duration-300">Rendez-vous</a>

            @auth
                <a href="{{ route('order-history') }}"
                    class="bg-red-500 text-white px-3 py-2 text-sm rounded-md hover:bg-red-600 transition duration-300">Commandes</a>
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
                        class="bg-red-500 inline-block  my-8 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300">Voir
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

    <section class="testimonies bg-red-700 text-white">
        <div class="container text-center mx-auto py-8">

            <div class="flex flex-col gap-6 px-4 font-semibold">
                <div class="testimonial p-4 ">
                    <p class="mb-2 text-2xl">"Les oracles de bienveillance et d'amour m'accompagnent chaque jour. Ils
                        m'aident
                        à trouver de la clarté"</p>
                    <p class="text-sm font-light">Marie</p>
                </div>

                <div class="testimonial p-4">
                    <p class="mb-2 text-2xl">"Chaque tirage est une occasion d'en apprendre davantage sur moi-même et de
                        trouver un équilibre"</p>
                    <p class="text-sm font-light">Christelle</p>
                </div>

                <div class="testimonial p-4">
                    <p class="mb-2 text-2xl">"Franchement, tirer une carte, ça m'aide à y voir plus clair et à prendre
                        du recul
                        sur pas mal de choses."</p>
                    <p class="text-sm font-light">Franck</p>
                </div>

                <div class="testimonial p-4">
                    <p class="mb-2 text-2xl">"Génial ! Livraison rapide !"</p>
                    <p class="text-sm font-light">Mélissa</p>
                </div>
            </div>

        </div>
    </section>
    <section class="about mb-5">
        <div class="container max-w-xl text-center mx-auto py-8">
            <h2 class="text-4xl mb-3 text-gray-600  font-semibold  ">Qui suis-je?</h2>
            <p class="text-gray-400 text-lg">

                Grâce à ma clairvoyance, je peux identifier les bons numéros du loto ainsi que le site où vous aurez le
                plus de chances de gagner. La voyance est un atout précieux pour prédire les tirages, bien que la
                datation précise d’un événement reste un défi pour tout voyant. Si un clairvoyant est en mesure de le
                faire, il agit selon son éthique. Lors de la consultation, je vous révélerai les numéros gagnants ainsi
                que la plateforme idéale pour jouer. En retour, après votre gain, vous respecterez votre engagement.


            </p>

        </div>
    </section>


</div>

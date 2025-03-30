<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <header class="container">
        @livewire('components.carousel.carousel')
        <div class="py-12 mx-auto text-center">
            <h2 class="text-4xl mb-3 text-red-500 italic font-semibold underline font-['Playfair_Display']">Bienvenue
                chez
                VOYANCE ET BIENVEILLANCE
            </h2>
            <p class="text-gray-500 text-lg">
                "Bienvenue dans mon univers ! Je suis Caroline, cartomancienne et créatrice d'oracles. je vous invite à
                découvrir mes Oracles, les Porte-Bonheur ainsi que la lithothérapie, conçus pour apporter harmonie,
                guidance et bien-être à votre quotidien."
            </p>
        </div>
    </header>

    {{-- @dump(auth()->user()) --}}

    <section class="best-seller bg-gray-100 py-16">

        <div class="container text-center mx-auto">
            <h2 class="text-4xl mb-10 text-gray-600  font-semibold  font-['Dancing_Script']">Meilleures ventes

            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-0">
                @isset($products)

                    @forelse ($products as $item)
                        {{-- @dump($item) --}}
                        @livewire(
                            'components.product.product-card',
                            [
                                'images' => $item->images,
                                'title' => $item->name,
                                'price' => $item->price,
                                'slug' => $item->slug,
                                'product' => $item,
                            ],
                            key($item->id)
                        )


                    @empty
                        @livewire('components.product.product-card', [
                            'images' => ['https://example.com/image1.jpg'],
                            'title' => 'Les Chuchotements du Cœur',
                            'price' => 45.99,
                            'slug' => 'les-chuchotements-du-coeur',
                        ])
                    @endforelse

                @endisset





            </div>



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

                Je suis Caroline, cartomancienne depuis des années. Voyance et Bienveillance est né de la passion que j'
                ai pour la cartomancie .Mon ambition avec cette boutique est de vous fournir des trésors spirituels –
                oracles, porte-bonheur et pierres de lithothérapie – pour vous accompagner vers un quotidien plus apaisé
                et lumineux.

                Explorez ma boutique et laissez-vous inspirer par la magie de

                Voyance et Bienveillance ❤️.


            </p>

        </div>
    </section>


</div>

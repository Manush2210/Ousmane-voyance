<div>

    <section class="best-seller bg-gray-100 py-16">

        <div class="container text-center mx-auto">
            <h2 class="text-4xl mb-10 text-gray-600  text-left font-semibold  font-['Dancing_Script']">Boutique
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-0">
                @forelse ($products as $item)
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


                @empty
                <div class="text-center">
                    <h3 class="text-2xl text-gray-600">Aucun produit trouvé</h3>
                    <p class="text-gray-500">Nous n'avons pas trouvé de produits correspondant à votre recherche.</p>
                </div>
                @endforelse



            </div>



        </div>

    </section>

    <section class="best-seller py-16">

        <div class="container text-left mx-auto">
            {{-- <h2 class="text-4xl mb-10 text-gray-600  text-left font-semibold  font-['Dancing_Script']">Boutique --}}
            </h2>
            <div class="flex flex-col gap-4">
                @forelse ($products as $item)
                    {{-- @dump($item) --}}
                    @livewire(
                        'components.product.product-list-view',
                        [
                            'images' => $item->images,
                            'title' => $item->name,
                            'price' => $item->price,
                            'slug' => $item->slug,
                            'description' => $item->description,
                        ],
                        key($item->id)
                    )
                @empty
                    {{-- No product found --}}
                    <div class="text-center">
                        <h3 class="text-2xl text-gray-600">Aucun produit trouvé</h3>
                        <p class="text-gray-500">Nous n'avons pas trouvé de produits correspondant à votre recherche.</p>
                    </div>
                @endforelse



            </div>



        </div>

    </section>
</div>

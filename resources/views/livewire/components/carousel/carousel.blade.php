<div x-data class="relative w-full" x-init="@if ($autoPlay) setInterval(() => { $wire.nextSlide() }, {{ $interval }}) @endif">
    <!-- Carousel wrapper -->
    <div class="relative overflow-hidden rounded-lg md:rounded-xl {{ $height }}">
        @foreach ($slides as $index => $slide)
            <div class="absolute inset-0 transition-all duration-700 ease-in-out transform {{ $index === $activeSlide ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full' }}"
                wire:key="slide-{{ $index }}">
                <img src="{{ $slide['image'] }}" class="block absolute w-full h-full object-cover"
                    alt="{{ $slide['title'] ?? 'Slide ' . ($index + 1) }}">

                <!-- Title and action overlay with improved mobile layout -->
                @if (isset($slide['title']))
                    <div
                        class="absolute inset-0 flex flex-col justify-end md:justify-center items-center bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 text-white">
                        <h3 class="drop-shadow-lg mb-4 font-bold text-2xl md:text-3xl text-center">{{ $slide['title'] }}
                        </h3>
                        @if (isset($slide['action']))
                            <div
                                class="w-full md:w-auto mb-8 md:mb-0 {{ $slide['action']['position'] ?? 'flex justify-center' }} z-20">
                                <a href="{{ $slide['action']['url'] }}"
                                    class="inline-block bg-emerald-600 hover:bg-emerald-500 shadow-xl px-6 py-3 rounded-full font-medium text-white md:text-base text-lg hover:scale-105 transition-all duration-300 transform">
                                    {{ $slide['action']['text'] }}
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Improved slider indicators -->
    <div
        class="bottom-4 md:bottom-6 left-1/2 z-30 absolute flex space-x-2 rtl:space-x-reverse md:space-x-3 -translate-x-1/2">
        @foreach ($slides as $index => $slide)
            <button type="button"
                class="w-2.5 h-2.5 md:w-3 md:h-3 rounded-full transition-all duration-300 {{ $index === $activeSlide ? 'bg-white scale-110' : 'bg-white/40 hover:bg-white/60' }}"
                aria-current="{{ $index === $activeSlide ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"
                wire:click="goToSlide({{ $index }})">
            </button>
        @endforeach
    </div>

    <!-- Enhanced slider controls -->
    <button type="button" class="group top-1/2 z-30 absolute focus:outline-none -translate-y-1/2 start-2 md:start-4"
        wire:click="prevSlide">
        <span
            class="inline-flex justify-center items-center bg-black/30 group-hover:bg-black/50 backdrop-blur-sm rounded-full group-focus:ring-4 group-focus:ring-white/50 w-8 md:w-12 h-8 md:h-12 transition-all duration-300">
            <svg class="w-4 md:w-6 h-4 md:h-6 text-white rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="group top-1/2 z-30 absolute focus:outline-none -translate-y-1/2 end-2 md:end-4"
        wire:click="nextSlide">
        <span
            class="inline-flex justify-center items-center bg-black/30 group-hover:bg-black/50 backdrop-blur-sm rounded-full group-focus:ring-4 group-focus:ring-white/50 w-8 md:w-12 h-8 md:h-12 transition-all duration-300">
            <svg class="w-4 md:w-6 h-4 md:h-6 text-white rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

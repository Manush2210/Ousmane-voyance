<div x-data class="relative w-full" x-init="@if ($autoPlay) setInterval(() => { $wire.nextSlide() }, {{ $interval }}) @endif">
    <!-- Carousel wrapper -->
    <div class="relative overflow-hidden rounded-lg md:rounded-xl {{ $height }}">
        @foreach ($slides as $index => $slide)
            <div class="absolute inset-0 transition-all duration-700 ease-in-out transform {{ $index === $activeSlide ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full' }}"
                wire:key="slide-{{ $index }}">
                <img src="{{ $slide['image'] }}" class="absolute block w-full h-full object-cover"
                    alt="{{ $slide['title'] ?? 'Slide ' . ($index + 1) }}">

                <!-- Title and action overlay with improved mobile layout -->
                @if (isset($slide['title']))
                    <div
                        class="absolute inset-0 flex flex-col justify-end md:justify-center items-center bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 text-white">
                        <h3 class="text-2xl md:text-3xl font-bold text-center mb-4 drop-shadow-lg">{{ $slide['title'] }}
                        </h3>
                        @if (isset($slide['action']))
                            <div
                                class="w-full md:w-auto mb-8 md:mb-0 {{ $slide['action']['position'] ?? 'flex justify-center' }} z-20">
                                <a href="{{ $slide['action']['url'] }}"
                                    class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white rounded-full shadow-xl transition-all duration-300 transform hover:scale-105 text-lg md:text-base font-medium">
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
        class="absolute z-30 flex -translate-x-1/2 bottom-4 md:bottom-6 left-1/2 space-x-2 md:space-x-3 rtl:space-x-reverse">
        @foreach ($slides as $index => $slide)
            <button type="button"
                class="w-2.5 h-2.5 md:w-3 md:h-3 rounded-full transition-all duration-300 {{ $index === $activeSlide ? 'bg-white scale-110' : 'bg-white/40 hover:bg-white/60' }}"
                aria-current="{{ $index === $activeSlide ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"
                wire:click="goToSlide({{ $index }})">
            </button>
        @endforeach
    </div>

    <!-- Enhanced slider controls -->
    <button type="button" class="absolute top-1/2 -translate-y-1/2 start-2 md:start-4 z-30 group focus:outline-none"
        wire:click="prevSlide">
        <span
            class="inline-flex items-center justify-center w-8 h-8 md:w-12 md:h-12 rounded-full bg-black/30 backdrop-blur-sm group-hover:bg-black/50 transition-all duration-300 group-focus:ring-4 group-focus:ring-white/50">
            <svg class="w-4 h-4 md:w-6 md:h-6 text-white rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-1/2 -translate-y-1/2 end-2 md:end-4 z-30 group focus:outline-none"
        wire:click="nextSlide">
        <span
            class="inline-flex items-center justify-center w-8 h-8 md:w-12 md:h-12 rounded-full bg-black/30 backdrop-blur-sm group-hover:bg-black/50 transition-all duration-300 group-focus:ring-4 group-focus:ring-white/50">
            <svg class="w-4 h-4 md:w-6 md:h-6 text-white rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

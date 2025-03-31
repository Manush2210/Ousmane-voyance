<?php

namespace App\Livewire\Components\Carousel;

use Livewire\Component;

class Carousel extends Component
{
    public $slides = [];
    public $activeSlide = 0;
    public $autoPlay = true;
    public $interval = 5000; // 5 seconds
    public $height = 'md:h-96 h-56';

    // Accept slides data (images, titles, action buttons)
    public function mount($slides = [], $autoPlay = true, $interval = 5000, $height = 'md:h-96 h-56')
    {
        $this->slides = !empty($slides) ? $slides : $this->getRandomSlides();
        $this->autoPlay = $autoPlay;
        $this->interval = $interval;
        $this->height = $height;
    }

    public function nextSlide()
    {
        if (count($this->slides) === 0) return;
        $this->activeSlide = ($this->activeSlide + 1) % count($this->slides);
    }

    public function prevSlide()
    {
        if (count($this->slides) === 0) return;
        $this->activeSlide = ($this->activeSlide - 1 + count($this->slides)) % count($this->slides);
    }

    public function goToSlide($index)
    {
        $this->activeSlide = $index;
    }

    protected function getRandomSlides()
    {
        $titles = [
            'Découvrez nos produits divinatoires exclusifs',
            'Consultations personnalisées',
            'Promotion sur les cartes de tarot',
            'Nouveaux arrivages de cristaux',
            'Rencontrez nos experts en voyance'
        ];

        $actions = [
            ['text' => 'En savoir plus', 'url' => route('shop')],
            ['text' => 'Découvrir', 'url' => route('shop')],
            ['text' => 'Voir la boutique', 'url' => route('shop')],
            ['text' => 'Prendre rendez-vous', 'url' => route('meeting')]
        ];

        $randomSlides = [];

        // Generate 3-5 random slides
        $numSlide = 5;

        for ($i = 1; $i < $numSlide; $i++) {
            // Using Picsum Photos for random placeholder images
            // $width = 1200;
            // $height = 600;
            //$randomId = rand(1, 1000);

            $randomSlides[] = [
                'image' => asset('assets/images/slides/slide-'.$i.'.jpeg'),
                'title' => $titles[array_rand($titles)],
                'action' => $actions[array_rand($actions)]
            ];
        }

        return $randomSlides;
    }

    public function render()
    {
        return view('livewire.components.carousel.carousel');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use Carbon\Carbon;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Marie',
                'message' => 'Les oracles de bienveillance et d\'amour m\'accompagnent chaque jour. Ils m\'aident à trouver de la clarté',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(30),
            ],
            [
                'name' => 'Christelle',
                'message' => 'Chaque tirage est une occasion d\'en apprendre davantage sur moi-même et de trouver un équilibre',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(25),
            ],
            [
                'name' => 'Franck',
                'message' => 'Franchement, tirer une carte, ça m\'aide à y voir plus clair et à prendre du recul sur pas mal de choses.',
                'rating' => 4,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(20),
            ],
            [
                'name' => 'Mélissa',
                'message' => 'Génial ! Livraison rapide !',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(18),
            ],
            [
                'name' => 'Sophie',
                'message' => 'Une expérience transformatrice ! Les conseils sont justes et m\'aident vraiment dans ma vie quotidienne.',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'name' => 'Laurent',
                'message' => 'J\'étais sceptique au début, mais les tirages sont vraiment pertinents. Ça m\'aide à mieux comprendre mes émotions.',
                'rating' => 4,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(12),
            ],
            [
                'name' => 'Isabelle',
                'message' => 'Un accompagnement bienveillant et professionnel. Les consultations m\'apportent la sérénité dont j\'avais besoin.',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'name' => 'Thomas',
                'message' => 'Les outils proposés sont excellents. J\'utilise régulièrement les tirages en ligne, c\'est très pratique.',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(8),
            ],
            [
                'name' => 'Amélie',
                'message' => 'Une approche respectueuse et éclairante. Chaque séance m\'apporte de nouvelles perspectives sur ma vie.',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'name' => 'David',
                'message' => 'Service de qualité avec des produits authentiques. Je recommande vivement cette plateforme.',
                'rating' => 5,
                'is_active' => true,
                'created_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'message' => $this->faker->sentence(rand(15, 30)),
            'rating' => $this->faker->numberBetween(3, 5),
            'photo' => null, // Par défaut pas de photo, utilisera l'initiale
            'is_active' => $this->faker->boolean(90), // 90% de chance d'être actif
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    /**
     * State pour un témoignage avec photo
     */
    public function withPhoto(): static
    {
        return $this->state(fn (array $attributes) => [
            'photo' => 'testimonials/' . $this->faker->uuid() . '.jpg',
        ]);
    }

    /**
     * State pour un témoignage 5 étoiles
     */
    public function fiveStars(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => 5,
        ]);
    }

    /**
     * State pour un témoignage inactif
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}

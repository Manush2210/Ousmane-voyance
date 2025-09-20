<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Autres seeders...
            AdminUserSeeder::class,
            ConsultationTypeSeeder::class,
            PaymentMethodSeeder::class,
            TimeSlotSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}

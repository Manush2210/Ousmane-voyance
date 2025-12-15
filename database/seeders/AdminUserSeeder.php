<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Ousm@2025'),
            'role' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'System',
            'phone' => '0123456789',
            'address' => '123 Admin Street',
            'postal_code' => '75000',
            'city' => 'Paris',
            'country' => 'France',
            'client_type' => 'pro',
            'email_verified_at' => now()
        ]);

        $this->command->info('Utilisateur admin créé avec succès!');
        $this->command->info('Email: admin@voyance-seb.com');
        $this->command->info('Mot de passe: Password123!');
    }
}

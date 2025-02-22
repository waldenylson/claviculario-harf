<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();

        \App\Models\User::factory()->create([
            'name' => 'waldenylsonwpss',
            'full_name' => 'Waldenylson Silva',
            'service_name' => 'Waldenylson',
            'military_rank' => '2S SIN',
            'military_unit' => 'CINDACTA III',
            'email' => 'test@example.com',
            'phone' => '(00)9999909999',
            'password' => Hash::make('123456'),
            'electronic_signature' => Hash::make('123456'),
            'email_verified_at' => now(),
        ]);
    }
}

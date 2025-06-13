<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        
        $this->call(\Database\Seeders\GuestUserSeeder::class);
        $this->call(\Database\Seeders\LevelSeeder::class);

        // Panggil seeder modul, tema, materi
        $this->call(\Database\Seeders\ModulSeeder::class);
        $this->call(\Database\Seeders\TemaSeeder::class);
        $this->call(\Database\Seeders\MateriSeeder::class);
        $this->call(\Database\Seeders\KuisSeeder::class);
    }
}

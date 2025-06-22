<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat semua user terlebih dahulu dengan cara yang aman (update or create)
        // Ini mencegah error "duplicate entry" jika seeder dijalankan lebih dari sekali.
        $irfan = User::updateOrCreate(
            ['email' => 'irfan@example.com'], // Cari user dengan email ini
            [                             // Jika tidak ada, buat dengan data ini (atau update jika ada)
                'name' => 'Irfan Maulana',
                'password' => 'password',
                'role' => 'user',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'role' => 'admin',
            ]
        );
        
        // Buat 10 user lainnya. Factory akan memastikan email mereka unik.
        User::factory(10)->create(); 

        // Ambil SEMUA user yang ada di database ke dalam satu collection
        $allUsers = User::all();

        // 2. Buat postingan-postingan
        // Menggunakan firstOrCreate untuk postingan utama agar tidak duplikat juga
        $mainPost = Post::firstOrCreate(
            [
                'user_id' => $irfan->id,
                'content' => 'Gan mau nanya, ada tips n trik wirausaha sambil kuliah ngga ya?',
            ],
            [
                'created_at' => '2025-04-15 13:00:00',
            ]
        );

        // Buat 20 postingan acak dari semua user yang ada
        Post::factory(20)->recycle($allUsers)->create();

        // Panggil seeder modul, tema, materi
        $this->call(\Database\Seeders\ModulSeeder::class);
        $this->call(\Database\Seeders\TemaSeeder::class);
        $this->call(\Database\Seeders\MateriSeeder::class);
        $this->call(\Database\Seeders\KuisSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\JudulMateri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JudulMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $judul = [
        'Apa Itu Wirausaha?',
        'Mindset Wirausaha?',
        'Video Rangkuman',
        'Kuis'
        ];

        foreach ($judul as $j) {
            JudulMateri::create(['sub_modul_id' => 1, 'judul' => $j,'created_at' => now(),'updated_at' => now()]);
        }

    }
}

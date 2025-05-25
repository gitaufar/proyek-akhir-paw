<?php

namespace Database\Seeders;

use App\Models\Tema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tema = [
        'Apa Itu Wirausaha?',
        'Mindset Wirausaha?',
        'Video Rangkuman',
        'Kuis'
        ];

        foreach ($tema as $j) {
            Tema::create(['modul_id' => 1, 'judul_tema' => $j,'created_at' => now(),'updated_at' => now()]);
        }
    }
}

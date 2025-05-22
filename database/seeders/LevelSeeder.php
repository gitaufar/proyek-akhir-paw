<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $moduls = [
            'Modul Pengenalan',
            'Modul Pemula',
            'Modul Intermediete',
            'Modul Expert',
        ];

        foreach ($moduls as $nama) {
            Level::create(['nama_level' => $nama,'created_at' => now(),'updated_at' => now()]);
        }
    }
}

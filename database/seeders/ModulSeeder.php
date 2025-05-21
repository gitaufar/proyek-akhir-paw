<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modul;

class ModulSeeder extends Seeder
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
            Modul::create(['nama' => $nama,'created_at' => now(),'updated_at' => now()]);
        }
    }
}

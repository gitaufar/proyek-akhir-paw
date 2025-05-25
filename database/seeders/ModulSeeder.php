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
        Modul::create(['level_id' => 1, 'nama_modul' => 'Dasar Dasar Kewirausahaan','deskripsi' => 'Pada modul ini anda akan belajar fundamental dari wirausaha','created_at' => now(),'updated_at' => now()]);
    }
}

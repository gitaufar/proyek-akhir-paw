<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubModul;

class SubModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SubModul::create(['modul_id' => 1, 'nama' => 'Dasar Dasar Kewirausahaan','created_at' => now(),'updated_at' => now()]);
    }
}

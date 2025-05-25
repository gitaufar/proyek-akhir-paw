<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Guest User',
            'email' => 'guest@domain.com',
            'password' => bcrypt('password'), // Password sementara
        ]);
        //
    }
}

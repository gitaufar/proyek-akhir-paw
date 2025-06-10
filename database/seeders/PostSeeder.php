<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Mengambil user_id secara acak dari user yang sudah ada
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'content' => fake()->realText(200),
        ];
    }
}
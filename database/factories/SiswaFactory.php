<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nis' => $this->faker->unique()->numerify('##########'),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['10pplg', '11pplg', '12pplg']),
            'password' => Hash::make('password123'),
        ];
    }
}

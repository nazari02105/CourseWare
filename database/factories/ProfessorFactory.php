<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "username" => $this->faker->name(),
            "email" => $this->faker->email(),
            "password" => Hash::make("123456"),
            "national_code" => rand(1000000000, 9999999999),
            "experience" => rand(5, 40),
            "age" => rand(25, 60),
            "status" => rand(0, 1),
        ];
    }
}

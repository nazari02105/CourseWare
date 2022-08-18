<?php

namespace Database\Factories;

use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "professor_id" => Professor::factory(),
            "title" => $this->faker->city(),
            "start_time" => "2021-06-10",
            "end_time" => "2021-06-15",
        ];
    }
}

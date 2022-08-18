<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "builder_id"=>Professor::factory(),
            "course_id"=>Course::factory(),
            "title"=>$this->faker->city(),
            "description"=>$this->faker->text(),
            "time"=>rand(15, 240),
        ];
    }
}

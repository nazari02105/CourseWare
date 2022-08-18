<?php

namespace Database\Factories;

use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "professor_id"=>Professor::factory(),
            "title"=>$this->faker->name(),
            "question"=>$this->faker->text(),
            "type"=>"descriptive",
        ];
    }
}

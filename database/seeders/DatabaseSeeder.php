<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Professor;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Professor::factory()->count(10)->create();
        Course::factory()->has(Student::factory()->count(5))->count(5)->create();
        Exam::factory()->count(5)->for(Professor::factory())->for(Course::factory())->create();
        Question::factory()->has(Exam::factory()->count(5))->count(5)->for(Professor::factory())->create();
    }
}

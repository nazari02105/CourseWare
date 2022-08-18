<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseStudentPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists("course_student");
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_id");
            $table->unsignedBigInteger("student_id");
            $table->foreign("course_id")->references("id")->on("courses");
            $table->foreign("student_id")->references("id")->on("students");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_student', function (Blueprint $table) {
            $table->drop();
        });
    }
}

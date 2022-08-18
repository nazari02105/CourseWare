<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("question_id");
            $table->unsignedBigInteger("student_id");
            $table->string("answer");
            $table->unsignedFloat("score")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_student');
    }
}

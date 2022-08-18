<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("exam_id");
            $table->unsignedBigInteger("question_id");
            $table->unsignedFloat("score")->nullable();
            $table->foreign("exam_id")->references("id")->on("exams");
            $table->foreign("question_id")->references("id")->on("questions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_question');
    }
}

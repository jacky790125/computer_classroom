<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->string('title');
            $table->string('title_img')->nullable();
            $table->string('ans_A');
            $table->string('ans_A_img')->nullable();
            $table->string('ans_B');
            $table->string('ans_B_img')->nullable();
            $table->string('ans_C');
            $table->string('ans_C_img')->nullable();
            $table->string('ans_D');
            $table->string('ans_D_img')->nullable();
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
        Schema::dropIfExists('course_questions');
    }
}

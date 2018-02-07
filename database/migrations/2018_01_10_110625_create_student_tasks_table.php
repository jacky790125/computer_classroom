<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('year_class_num');
            $table->text('report')->nullable();
            $table->unsignedInteger('score')->nullable();
            $table->string('saying')->nullable();
            $table->unsignedInteger('public')->nullable();//0不公開，1公開
            $table->unsignedInteger('views')->default('0');
            $table->unsignedInteger('likes')->default('0');
            $table->unsignedInteger('to_money')->nullable();
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
        Schema::dropIfExists('student_tasks');
    }
}

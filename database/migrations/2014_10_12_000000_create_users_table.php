<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();//登入帳號
            $table->string('password');
            $table->string('name');
            $table->string('nickname')->nullable();//暱稱
            $table->unsignedInteger('sex')->nullable();//1男,2女
            $table->string('year_class_num')->nullable();//學生的年班座號
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('active');//0停用,null or 1啟用 or 2轉出
            $table->unsignedInteger('money')->nullable();
            $table->string('avatar')->nullable();//個人頭像
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

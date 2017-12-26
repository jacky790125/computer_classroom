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
            $table->unsignedInteger('sex')->nullable();//1男,2女
            $table->string('year_class_num')->nullable();//學生的年_班_座號
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('un_active')->nullable();//1停用,null or 0 啟用
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

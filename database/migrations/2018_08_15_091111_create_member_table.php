<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->text('dob');
            $table->string('age');
            $table->string('id_num');
            $table->string('address');
            $table->string('university');
            $table->text('faculty');
            $table->text('major');
            $table->string('gpa');
            $table->text('job');
            $table->string('workexpr');
            $table->string('skill');
            $table->string('interest');
            $table->string('another');
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
        Schema::dropIfExists('member');
    }
}

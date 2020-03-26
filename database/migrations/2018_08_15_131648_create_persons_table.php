<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('persons', function (Blueprint $table) {
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
            $table->string('university')->nullable();
            $table->text('faculty')->nullable();
            $table->text('major')->nullable();
            $table->string('gpa')->nullable();
            $table->text('job')->nullable();
            $table->string('workexpr')->nullable();
            $table->string('skill')->nullable();
            $table->string('interest')->nullable();
            $table->string('another')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('persons');
    }
}

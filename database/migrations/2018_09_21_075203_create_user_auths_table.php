<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_auths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('structure_id')->unsigned();
            $table->foreign('structure_id')->references('id')->on('structure');
            $table->integer('block_id')->unsigned();
            $table->foreign('block_id')->references('id')->on('block');
            $table->string('description');
            $table->timestamps();
            $table->unique(['user_id', 'structure_id','block_id']);
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_auths');
    }
}

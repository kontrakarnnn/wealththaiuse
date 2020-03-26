<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persons', function (Blueprint $table) {
          $table->string('gender');
          $table->string('nationality');
          $table->string('religion');
          $table->string('couple');
          $table->string('income');
          $table->string('inctype');
          $table->string('incbonus');
          $table->string('bankaccount');
          $table->string('bank');
          $table->string('activestatus')->nullable();
          $table->string('add1')->nullable();
          $table->string('add1_alley')->nullable();
          $table->string('add1_road')->nullable();
          $table->string('add1_subdistrict')->nullable();
          $table->string('add1_district')->nullable();
          $table->string('add1_city')->nullable();
          $table->string('add1_postcode')->nullable();
          $table->string('add2_tel')->nullable();
          $table->string('add2_fax')->nullable();
          $table->string('add3')->nullable();
          $table->string('company')->nullable();
          $table->string('position')->nullable();
          $table->string('com_add_no')->nullable();
          $table->string('com_add_alley')->nullable();
          $table->string('com_add_road')->nullable();
          $table->string('com_add_subdistrict')->nullable();
          $table->string('com_add_district')->nullable();
          $table->string('com_add_city')->nullable();
          $table->string('com_add_postcode')->nullable();
          $table->string('com_tel')->nullable();
          $table->string('com_fax')->nullable();
          $table->string('couple_name')->nullable();
          $table->string('couple_lname')->nullable();
          $table->string('couple_job')->nullable();
          $table->string('couple_phone')->nullable();
          $table->string('couple_workplace')->nullable();
          $table->string('couple_ref')->nullable();
          $table->string('couple_loc')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persons', function (Blueprint $table) {
            //
        });
    }
}

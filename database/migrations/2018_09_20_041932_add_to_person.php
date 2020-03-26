<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persons', function (Blueprint $table) {
          $table->string('add2')->nullable()->after('add2_fax');
          $table->string('add2_alley')->nullable()->after('add2');
          $table->string('add2_road')->nullable()->after('add2_alley');
          $table->string('add2_subdistrict')->nullable()->after('add2_road');
          $table->string('add2_district')->nullable()->after('add2_subdistrict');
          $table->string('add2_city')->nullable()->after('add2_district');
          $table->string('add2_postcode')->nullable()->after('add2_city');
          $table->string('add2_sentdoc')->nullable()->after('add2_postcode');
          
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

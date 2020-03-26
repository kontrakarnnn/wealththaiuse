<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPorttypeToPortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio', function (Blueprint $table) {
          $table->integer('port_id')->unsigned()->index()->nullable();
          $table->foreign('port_id')->references('id')->on('port_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolio', function (Blueprint $table) {
            $table->dropColumn('port_id');
        });
    }
}

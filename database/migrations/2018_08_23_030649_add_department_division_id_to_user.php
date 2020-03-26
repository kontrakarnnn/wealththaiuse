<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentDivisionIdToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->integer('department_id')->unsigned()->index()->nullable();

          $table->foreign('department_id')->references('id')->on('department');

          $table->integer('division_id')->unsigned()->index()->nullable();

          $table->foreign('division_id')->references('id')->on('division');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('department_id');
            $table->dropColumn('division_id');
        });
    }
}

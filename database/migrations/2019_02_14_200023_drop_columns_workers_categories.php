<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsWorkersCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('workers_categories', function (Blueprint $table) {
        $table->dropColumn('puesto_trabajo');
        $table->dropColumn('sueldo_neto');
        $table->dropColumn('sueldo_neto_texto');
        $table->dropColumn('contrato');
      });

      Schema::table('workers_categories', function (Blueprint $table) {
        $table->string('sueldo_basico')->after('name');
        $table->string('sueldo_adicional')->after('sueldo_basico');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

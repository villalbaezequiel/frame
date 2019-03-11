<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddColumnProjectProvider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('project_providers', function ($table) {
        $table->dropColumn('active');
      });
      Schema::table('project_providers', function ($table) {
        // por default 0,
        // cuando se le envia el mail con la solicitud del Proyecto y la aceptan, cambia el status a 1.
        // si la rechaza = 2
        $table->enum('active', [0, 1, 2])->after('extra_hours');
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

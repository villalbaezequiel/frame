<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddColumnProjectProviderV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('project_providers', function($table){
        $table->dropColumn('active');
      });

      Schema::table('project_providers', function ($table) {
        $table->integer('count_workdays_crew')->after('finish_date_contract');
        // por default 0,
        // cuando se le envia el mail con la solicitud del Proyecto y la aceptan, cambia el status a 1.
        // si la rechaza = 2
        $table->enum('active', [0, 1, 2])->after('extra_hours');
        $table->enum('is_reemplazo', ['1', '0', '2'])->after('finish_afip'); // 0 CANCELADO, 1 TITULAR, 2 SECUNDARIO
        $table->string('id_crew_reemplazo')->nullable()->after('is_reemplazo');
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

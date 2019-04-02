<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddColumnProjectProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('project_providers', function ($table) {
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

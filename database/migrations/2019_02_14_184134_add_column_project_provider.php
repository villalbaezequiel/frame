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
          $table->dropColumn('id_function_sat');
          $table->integer('id_function_frame')->after('id_project');
          $table->dropColumn('start_date');
          $table->dropColumn('finish_date');
          $table->timestamp('start_date_contract')->after('salary_liquidate')->nullable();
          $table->timestamp('finish_date_contract')->after('start_date_contract')->nullable();
          $table->timestamp('start_afip')->after('finish_date_contract')->nullable();
          $table->timestamp('finish_afip')->after('start_afip')->nullable();
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

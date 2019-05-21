<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnProvidersProjectsOr014 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('project_providers', function ($table) {
        $table->integer('id_workday')->after('id_contract');
        $table->string('hour_initial')->nullable()->after('count_workdays_crew');
        $table->string('hour_end')->nullable()->after('hour_initial');
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

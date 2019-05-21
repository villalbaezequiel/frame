<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnProjectsOr014 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('projects', function ($table) {
        $table->dropColumn('count_workdays');
        $table->dropColumn('duration_workdays');
        $table->dropColumn('id_workday');
        $table->dropColumn('days');
        $table->string('observations')->nullable()->after('description');
        $table->string('cost_center')->nullable()->after('observations');
        $table->integer('id_team_referring')->nullable()->after('id_proyect_category');

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

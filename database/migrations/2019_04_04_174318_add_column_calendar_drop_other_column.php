<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCalendarDropOtherColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('project_providers', function (Blueprint $table) {
        $table->dropColumn('value_extra_hours');
      });

      Schema::table('project_providers', function (Blueprint $table) {
        $table->string('calendar', 10000)->nullable()->after('id_crew_reemplazo');
        /*
          Ejemplo:
          calendar ->
          {
           	{
          		day: “00-00-0000 ”,
          		start_date: “00:00:00”,
          		finish_date: “00:00:00”,
          	},
          	{
          		day: “00-00-0000 ”,
          		start_date: “00:00:00”,
          		finish_date: “00:00:00”,
          	}
          }

          extra_hours ->
          {
          	{
          		start_date: “00:00:00”,
          		finish_date: “00:00:00”,
          		count: ’10’,
          		price: ’1.000,00’,
          	},
          	{
          		start_date: “00:00:00”,
          		finish_date: “00:00:00”,
          		count: ’10’,
          		price: ’1.000,00’,
          	}
          }

        */
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

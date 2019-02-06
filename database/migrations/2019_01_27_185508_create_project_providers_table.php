<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project');
            $table->integer('id_function_sat');
            $table->integer('id_provider');
            $table->integer('id_contract');
            $table->string('salary_workdays');
            $table->string('total_workdays');
            $table->string('salary_contract_category_function');
            $table->string('salary_daily');
            $table->string('salary_liquidate');
            $table->string('start_date')->nullable();
            $table->string('finish_date')->nullable();
            $table->string('value_extra_hours');
            $table->string('extra_hours', 2500)->nullable(); //json ("fecha", "horarios", "comentarios: porque hubo hs extras?")
            $table->enum('active', [0, 1]); // por default 0, cuando se le envia el mail con la solicitud del Proyecto y la aceptan, cambia el status a 1.
            $table->timestamps();

            // JOIN Projects
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_providers');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_client');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('id_proyect_category');
            $table->timestamps('start_date');
            $table->timestamps('finish_date');
            $table->integer('count_workdays');
            $table->integer('duration_workdays');
            $table->integer('id_work_modality'); // create ABM
            $table->integer('days');
            $table->enum('active', ['0', '1']);
            $table->timestamps();

            // JOIN project_providers
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

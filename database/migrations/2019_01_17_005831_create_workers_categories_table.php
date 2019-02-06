<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('puesto_trabajo');
            $table->string('sueldo_bruto');
            $table->string('sueldo_bruto_texto', 300)->nullable();
            $table->string('sueldo_neto');
            $table->string('sueldo_neto_texto', 300)->nullable();
            $table->string('presentismo')->nullable();
            $table->string('contrato')->nullable();
            $table->enum('active', [0, 1]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers_categories');
    }
}

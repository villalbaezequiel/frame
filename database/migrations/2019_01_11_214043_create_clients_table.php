<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('nick');
            $table->string('razon_social');
            $table->string('address');
            $table->integer('address_number');
            $table->integer('cp');
            $table->string('location');
            $table->string('telephone');
            $table->string('other_telephone')->nullable();
            $table->enum('retencion_ganancia', ['0', '1']);
            $table->enum('iibb', ['0', '1']);
            $table->enum('iva', ['0', '1']);
            $table->timestamps();
            // name, last_name, email, type_dni, dni, cuit, gender, id_country JOIN -> User
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

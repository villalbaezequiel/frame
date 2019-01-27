<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('address');
            $table->integer('address_number');
            $table->integer('cp');
            $table->string('location');
            $table->string('nationality');
            $table->integer('id_study');
            $table->string('social_work')->nullable();
            $table->string('telephone');
            $table->string('other_telephone')->nullable();
            $table->integer('id_workers_category');
            $table->integer('id_function_sat');
            $table->integer('id_function_frame');
            $table->timestamps();

            /*
              name,
              email,
              last_name,
              type_dni,
              dni,
              cuit,
              gender,
              civil_status,
              birthdate,
              id_country

              JOIN -> User
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
        Schema::dropIfExists('providers');
    }
}

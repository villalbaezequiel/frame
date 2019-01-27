<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function ($table) {
          $table->string('last_name')->nullable()->after('name');
          $table->string('type_dni')->nullable()->after('email');
          $table->string('dni')->nullable()->after('type_dni');
          $table->string('cuit')->nullable()->after('dni');
          $table->string('gender')->nullable()->after('cuit');
          $table->string('civil_status')->nullable()->after('gender');
          $table->timestamp('birthdate')->nullable()->after('civil_status');
          $table->string('id_country')->nullable()->after('birthdate');
          $table->enum('active', ['1', '0'])->after('password');
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

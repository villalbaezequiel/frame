<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('clients', function ($table) {
        $table->dropColumn('id_user');
        $table->string('cuit')->after('nick');
        $table->integer('id_country')->after('address_number');
        $table->string('contact_name')->after('other_telephone')->nullable();
        $table->string('contact_email')->after('contact_name')->nullable();
        $table->string('contact_telephone')->after('contact_email')->nullable();
        $table->enum('active', ['0', '1'])->after('iva');

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

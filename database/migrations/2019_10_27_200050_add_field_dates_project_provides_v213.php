<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldDatesProjectProvidesV213 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('project_providers', function (Blueprint $table) {
        $table->timestamp('start_date_secure_contract')->nullable()->after('finish_afip');
        $table->timestamp('end_date_secure_contract')->nullable()->after('start_date_secure_contract');
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

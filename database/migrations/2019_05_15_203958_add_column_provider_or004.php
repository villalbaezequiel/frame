<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProviderOr004 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('providers', function (Blueprint $table) {
        $table->string('bank')->after('cbu');
        $table->string('type_account')->after('bank');
        $table->string('number_account')->after('type_account');
        $table->string('alias_account')->after('number_account');
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

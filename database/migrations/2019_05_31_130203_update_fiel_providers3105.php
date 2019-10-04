<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFielProviders3105 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('providers', function (Blueprint $table) {
        $table->enum('visa', [0, 1])->nullable()->after('nationality');
      });
      Schema::table('providers', function (Blueprint $table) {
        $table->dropColumn('alias_account');
      });
      Schema::table('providers', function (Blueprint $table) {
        $table->string('alias_account')->nullable()->after('number_account');
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

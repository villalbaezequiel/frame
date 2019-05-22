<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnByProvidersOr004 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('providers', function (Blueprint $table) {
        $table->dropColumn('social_work');
      });

      Schema::table('providers', function (Blueprint $table) {
        // update social_work varchar -> enum = 0,1
        $table->enum('social_work', ['0','1'])->nullable()->after('id_study');
        $table->string('social_work_code')->nullable()->after('social_work');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFildProducerOrdersProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('is_producer_order', [0, 1])->nullable()->after('certificado_cobertura');
            $table->integer('iduser_producer_order')->nullable()->after('is_producer_order');
            $table->enum('status_producer_order', [0, 1, 2])->nullable()->after('iduser_producer_order');
            // 0 standby
            // 1 accepted
            // 2 cancelled
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

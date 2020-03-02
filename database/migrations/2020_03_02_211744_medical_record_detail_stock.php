<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MedicalRecordDetailStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->unsignedInteger('stock_id')->nullable(true)->index();

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
            $table->dropColumn(['stock_id']);
        });
    }
}

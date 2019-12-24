<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BhpMedicalRecordDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->unsignedInteger('lokasi_id')->nullable(true)->index();
            $table->integer('is_bhp')->nullable(false)->default(0)->index();
            $table->integer('is_sewa_alkes')->nullable(false)->default(0)->index();
            $table->integer('is_sewa_ruangan')->nullable(false)->default(0)->index();
            $table->foreign('lokasi_id')
              ->references('id')->on('permissions')
              ->onDelete('restrict');
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
            $table->dropForeign(['lokasi_id']);
            $table->dropColumn(['is_bhp', 'is_sewa_alkes', 'is_sewa_ruangan', 'lokasi_id']);
        });
    }
}

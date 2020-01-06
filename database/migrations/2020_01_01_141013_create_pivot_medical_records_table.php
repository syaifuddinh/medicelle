<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_medical_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('medical_record_id')->nullable(false)->index();
            $table->unsignedInteger('registration_detail_id')->nullable(false)->index();
            $table->foreign('medical_record_id')
              ->references('id')->on('medical_records')
              ->onDelete('restrict');
            $table->foreign('registration_detail_id')
              ->references('id')->on('registration_details')
              ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_medical_records');
    }
}

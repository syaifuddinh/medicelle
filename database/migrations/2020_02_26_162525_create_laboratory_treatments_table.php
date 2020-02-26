<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoryTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_treatments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('price_id')->nullable(false)->index();
            $table->unsignedInteger('laboratory_type_id')->nullable(false)->index();
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
            $table->foreign('laboratory_type_id')->references('id')->on('laboratory_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratory_treatments');
    }
}

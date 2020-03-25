<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologyTypeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiology_type_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('radiology_type_id')->nullable(false)->index();
            $table->string('name', 50);
            $table->timestamps();


            $table->foreign('radiology_type_id')->references('id')->on('radiology_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radiology_type_details');
    }
}

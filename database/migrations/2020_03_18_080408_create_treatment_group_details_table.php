<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentGroupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_group_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('treatment_group_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('qty')->nullable(false)->default(0);
            $table->timestamps();

            $table->foreign('treatment_group_id')->references('id')->on('treatment_groups')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_group_details');
    }
}

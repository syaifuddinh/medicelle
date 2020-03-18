<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->integer('percentage')->nullable(false)->default(0);
            $table->unsignedInteger('grup_nota_id')->nullable(false)->index();
            $table->unsignedInteger('is_active')->nullable(false)->default(1)->index();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('grup_nota_id')->references('id')->on('permissions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_groups');
    }
}

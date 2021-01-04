<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('equipment_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false);
            $table->unsignedInteger('lokasi_id')->nullable(false);
            $table->integer('qty')->nullable(false)->default(0);
            $table->smallInteger('is_approve')->nullable(false)->default(0);
            $table->unsignedInteger('stock_transaction_id')->nullable(true)->index();
            $table->timestamps();

            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('stock_transaction_id')->references('id')->on('stock_transactions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('movement_id')->nullable(false)->index();
            $table->unsignedInteger('stock_awal_id')->nullable(true)->index();
            $table->unsignedInteger('stock_transaction_source_id')->nullable(false)->index();
            $table->unsignedInteger('stock_transaction_destination_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('lokasi_awal_id')->nullable(false)->index();
            $table->unsignedInteger('lokasi_akhir_id')->nullable(false)->index();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('stock_transaction_source_id')->references('id')->on('stock_transactions')->onDelete('restrict');
            $table->foreign('stock_transaction_destination_id')->references('id')->on('stock_transactions')->onDelete('restrict');
            $table->foreign('stock_awal_id')->references('id')->on('stocks')->onDelete('restrict');
            $table->foreign('lokasi_awal_id')->references('id')->on('permissions')->onDelete('restrict');
            $table->foreign('lokasi_akhir_id')->references('id')->on('permissions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movement_details');
    }
}

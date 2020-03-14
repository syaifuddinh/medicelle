<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustment_stock_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('adjustment_stock_id')->nullable(false)->index();
            $table->unsignedInteger('stock_awal_id')->nullable(true)->index();
            $table->unsignedInteger('stock_transaction_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('previous_qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('qty')->nullable(false)->default(0)->index();
            $table->date('previous_expired_date')->nullable(true)->index();
            $table->date('expired_date')->nullable(true)->index();
            $table->unsignedInteger('lokasi_id')->nullable(false)->index();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('stock_transaction_id')->references('id')->on('stock_transactions')->onDelete('restrict');
            $table->foreign('stock_awal_id')->references('id')->on('stocks')->onDelete('restrict');
            $table->foreign('lokasi_id')->references('id')->on('permissions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjustment_stock_details');
    }
}

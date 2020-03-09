<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->date('date')->nullable(false)->index();
            $table->unsignedInteger('stock_id')->nullable(true)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('supplier_id')->nullable(true)->index();
            $table->date('expired_date')->nullable(true)->index();
            $table->unsignedInteger('lokasi_id')->nullable(false)->index();
            $table->unsignedInteger('receipt_detail_id')->nullable(true)->index();
            $table->unsignedInteger('in_qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('out_qty')->nullable(false)->default(0)->index();

            $table->unsignedInteger('amount')->nullable(false)->default(0)->index();
            $table->text('description')->nullable(true)->index();

            $table->foreign('supplier_id')->references('id')->on('contacts')->onDelete('restrict');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
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
        Schema::dropIfExists('stock_transactions');
    }
}

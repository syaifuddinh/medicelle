<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('receipt_id')->nullable(false)->index();
            $table->unsignedInteger('purchase_order_detail_id')->nullable(false)->index();
            $table->unsignedInteger('stock_transaction_id')->nullable(true)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->date('expired_date')->nullable(true)->index();
            $table->unsignedInteger('qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('purchase_price')->nullable(false)->default(0)->index();
            $table->unsignedInteger('hna')->nullable(false)->default(0)->index();
            $table->unsignedInteger('discount')->nullable(false)->default(0)->index();
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
        Schema::dropIfExists('receipt_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('purchase_order_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('received_qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('leftover_qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('purchase_price')->nullable(false)->default(0)->index();
            $table->unsignedInteger('discount')->nullable(false)->default(0)->index();
            $table->timestamps();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
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
        DB::table('purchase_requests')
        ->update([
            'is_approve' => 0
        ]);
        Schema::dropIfExists('purchase_order_details');
    }
}

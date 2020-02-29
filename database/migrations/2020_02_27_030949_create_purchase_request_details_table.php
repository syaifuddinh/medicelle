<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('supplier_id')->nullable(false)->index();
            $table->unsignedInteger('qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('purchase_price')->nullable(false)->default(0)->index();
            $table->unsignedInteger('discount')->nullable(false)->default(0)->index();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('supplier_id')->references('id')->on('contacts')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_request_details');
    }
}

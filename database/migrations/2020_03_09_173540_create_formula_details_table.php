<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formula_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('formula_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('lokasi_id')->nullable(false)->index();
            $table->unsignedInteger('qty')->nullable(false)->default(0)->index();
            $table->unsignedInteger('stock_id')->nullable(false)->index();
            $table->unsignedInteger('stock_transaction_id')->nullable(true)->index();
            $table->timestamps();

            $table->foreign('formula_id')->references('id')->on('formulas')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('lokasi_id')->references('id')->on('permissions')->onDelete('restrict');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('restrict');
            $table->foreign('stock_transaction_id')->references('id')->on('stock_transactions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formula_details');
    }
}

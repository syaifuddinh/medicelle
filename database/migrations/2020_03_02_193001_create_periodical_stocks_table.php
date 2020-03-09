<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodicalStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodical_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year')->nullable(false)->index();
            $table->integer('month')->nullable(false)->index();
            $table->unsignedInteger('stock_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('lokasi_id')->nullable(false)->index();
            $table->date('expired_date')->nullable(true)->index();
            $table->integer('gross')->nullable(false)->default(0)->index();
            $table->integer('netto')->nullable(false)->default(0)->index();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('lokasi_id')->references('id')->on('permissions')->onDelete('restrict');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodical_stocks');
        DB::table('items')
        ->update(['current_stock' => 0]);
    }
}

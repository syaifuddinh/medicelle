<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->unsignedInteger('lokasi_id')->nullable(false)->index();
            $table->date('expired_date')->nullable(true)->index();
            $table->integer('qty')->nullable(false)->default(0)->index();
            $table->timestamps();

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
        Schema::dropIfExists('stocks');
    }
}

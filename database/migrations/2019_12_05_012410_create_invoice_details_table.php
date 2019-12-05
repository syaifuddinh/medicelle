<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('invoice_id')->nullable(false)->index();
            $table->unsignedInteger('item_id')->nullable(false)->index();
            $table->integer('qty')->nullable(false)->default(0)->index();
            $table->double('debet')->nullable(false)->default(0)->index();
            $table->double('credit')->nullable(false)->default(0)->index();
            $table->double('total_debet')->nullable(false)->default(0)->index();
            $table->double('total_credit')->nullable(false)->default(0)->index();
            $table->double('grandtotal')->nullable(false)->default(0)->index();

            $table->integer('is_item')->nullable(false)->default(0)->index();
            $table->integer('is_discount')->nullable(false)->default(0)->index();
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
        Schema::dropIfExists('invoice_details');
    }
}

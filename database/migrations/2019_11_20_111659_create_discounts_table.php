<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30)->unique();
            $table->string('name', 200)->index();
            $table->date('date_start');
            $table->date('date_end');
            $table->index(['date_start', 'date_end']);
            $table->enum('type', ['PROMO', 'PAKET'])->default('PROMO')->index();
            $table->string('description')->nullable(true);
            $table->integer('disc_percent')->nullable(false)->default(0);
            $table->double('disc_value')->nullable(false)->default(0);
            $table->integer('is_active')->nullable(false)->default(1)->index();
            $table->unsignedInteger('created_by')->nullable(false)->index();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('discounts');
    }
}

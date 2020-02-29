<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable(false)->index();  
            $table->date('date_start')->nullable(false)->index();  
            $table->date('date_end')->nullable(false)->index();  
            $table->text('description')->nullable(true)->index();  
            $table->unsignedInteger('is_approve')->nullable(false)->default(1)->index();  
            $table->unsignedInteger('created_by')->nullable(false)->index();
            $table->text('additional')->nullable(false)->default('{}') ;
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_requests');
    }
}

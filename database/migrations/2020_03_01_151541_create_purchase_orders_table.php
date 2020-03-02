<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable(false)->index();  
            $table->string('code', 35)->nullable(false)->unique(); 
             $table->unsignedInteger('purchase_request_id')->nullable(false)->index(); 
             $table->unsignedInteger('supplier_id')->nullable(false)->index(); 
            $table->date('date_start')->nullable(false)->index();  
            $table->date('date_end')->nullable(false)->index();  
            $table->text('description')->nullable(true)->index();  
            $table->unsignedInteger('is_receipt_completed')->nullable(false)->default(0)->index();  
            $table->unsignedInteger('is_used')->nullable(false)->default(0)->index();  
            $table->unsignedInteger('created_by')->nullable(false)->index();
            $table->text('additional')->nullable(false)->default('{}') ;
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('purchase_orders');
    }
}

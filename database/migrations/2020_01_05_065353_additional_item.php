<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionalItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->text('additional')->nullable(false)->default('{}');
            $table->unsignedInteger('purchase_piece_id')->nullable(true)->index();
            $table->double('purchase_price')->nullable(false)->default(0)->index();
            $table->double('supplier_price')->nullable(false)->default(0)->index();
            $table->integer('minimal_stock')->nullable(false)->default(0)->index();
            $table->integer('ratio')->nullable(false)->default(0)->index();

            $table->integer('is_alkes_disposible')->nullable(false)->default(0)->index();
            $table->integer('is_alkes_non_disposible')->nullable(false)->default(0)->index();
            $table->integer('is_umum')->nullable(false)->default(0)->index();
            $table->integer('is_inventaris')->nullable(false)->default(0)->index();
            $table->integer('is_non_cure')->nullable(false)->default(0)->index();
            $table->integer('is_medical_item')->nullable(false)->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['additional', 'purchase_price', 'supplier_price', 'purchase_piece_id', 'minimal_stock','ratio','is_alkes_disposible','is_alkes_non_disposible','is_umum','is_inventaris','is_non_cure','is_medical_item']);
        });
    }
}

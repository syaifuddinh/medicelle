<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CurrentStockItemAndGudangFarmasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('current_stock')->nullable(false)->default(0)->index();
            $table->integer('has_stock')->nullable(false)->default(0)->index();
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->integer('is_gudang_farmasi')->nullable(false)->default(0);
        });

        $latest_lokasi_id = DB::table('permissions')
        ->whereIsLokasi(1)
        ->max('id');

        DB::table('permissions')
        ->whereId($latest_lokasi_id)
        ->update([
            'is_gudang_farmasi' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['current_stock', 'has_stock']);
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn(['is_gudang_farmasi']);
        });
    }
}

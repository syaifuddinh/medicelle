<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PriceIdInRadiologyTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radiology_types', function (Blueprint $table) {
            $table->unsignedInteger('price_id')
            ->nullable(true)
            ->index();
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('radiology_types', function (Blueprint $table) {
            $table->dropForeign(['price_id']);
            $table->dropColumn(['price_id']);
        });
    }
}

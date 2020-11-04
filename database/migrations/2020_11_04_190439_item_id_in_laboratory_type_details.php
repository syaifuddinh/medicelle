<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemIdInLaboratoryTypeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratory_type_details', function (Blueprint $table) {
            $table->unsignedInteger('item_id')->nullable(true);

            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laboratory_type_details', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropColumn(['item_id']);
        });
    }
}

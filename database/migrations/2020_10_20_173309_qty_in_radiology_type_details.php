<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QtyInRadiologyTypeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radiology_type_details', function (Blueprint $table) {
            $table->integer('qty')->nullable(false)->default(0);
            $table->unsignedInteger('item_id')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('radiology_type_details', function (Blueprint $table) {
            $table->dropColumn(['qty', 'item_id']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Obat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedInteger('is_classification')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_subclassification')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_generic')->nullable(false)->default(0)->index();

            $table->unsignedInteger('classification_id')->nullable(true)->index();
            $table->unsignedInteger('subclassification_id')->nullable(true)->index();
            $table->unsignedInteger('generic_id')->nullable(true)->index();
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
            $table->dropColumn(['classification_id', 'generic_id', 'subclassification_id', 'is_classification', 'is_subclassification', 'is_generic']);
        });
    }
}

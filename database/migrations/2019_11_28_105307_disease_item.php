<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiseaseItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('code', 45)->nullable(false)->index();
            $table->string('name', 200)->nullable(false)->index();
            $table->text('description')->nullable(true)->index();
            $table->double('price')->nullable(false)->default(0)->index();
            $table->unsignedInteger('category_id')->nullable(true)->index();
            $table->integer('is_active')->nullable(false)->default(1)->index();
            $table->integer('is_category')->nullable(false)->default(0);
            $table->integer('is_disease')->nullable(false)->default(0);
            $table->integer('is_administration')->nullable(false)->default(0);
            $table->integer('is_inspection')->nullable(false)->default(0);
            $table->integer('is_standard')->nullable(false)->default(0);
            $table->integer('is_radiology')->nullable(false)->default(0);
            $table->integer('is_anatomy')->nullable(false)->default(0);
            $table->integer('is_packet')->nullable(false)->default(0);
            $table->integer('is_pharmacy')->nullable(false)->default(0);

            $table->index(['is_pharmacy', 'is_category', 'is_disease', 'is_administration', 'is_inspection', 'is_standard', 'is_radiology', 'is_anatomy', 'is_packet', 'is_pharmacy']);
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
            $table->dropColumn(['is_pharmacy', 'is_category', 'is_disease', 'is_administration', 'is_inspection', 'is_standard', 'is_radiology', 'is_anatomy', 'is_packet', 'is_active' , 'category_id', 'price', 'name', 'code', 'description']);
        });
    }
}

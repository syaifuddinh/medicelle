<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PriceInLaboratoryTypeDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratory_type_details', function (Blueprint $table) {
            $table->double('price') 
            ->nullable(false)
            ->default(0)
            ->index();
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
            $table->dropColumn(['price']);
        });
    }
}

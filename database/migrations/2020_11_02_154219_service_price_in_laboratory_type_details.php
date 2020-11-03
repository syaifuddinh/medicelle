<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServicePriceInLaboratoryTypeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratory_type_details', function (Blueprint $table) {
            $table->double('service_price')->nullable(false)->default(0);
            $table->smallInteger('percentage')->nullable(false)->default(0);
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
            $table->dropColumn(['service_price', 'percentage']);
        });
    }
}

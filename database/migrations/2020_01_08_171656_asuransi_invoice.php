<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsuransiInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
            $table->integer('asuransi_percentage')->nullable(false)->default(0)->index();
            $table->integer('asuransi_value')->nullable(false)->default(0)->index();
        });
        Schema::table('invoice_details', function (Blueprint $table) {
            //
            $table->integer('is_asuransi')->nullable(false)->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['asuransi_value', 'asuransi_percentage']);
        });
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->dropColumn(['is_asuransi']);
        });
    }
}

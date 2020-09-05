<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePaymentMethodInInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->enum('payment_method', ['TUNAI', 'KREDIT', 'TT', 'VISA', 'MASTER', 'DEBIT'])
            ->nullable(false)
            ->default('TUNAI');
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
            $table->dropColumn('payment_method');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->enum('payment_method', ['TUNAI', 'KREDIT', 'TT', 'VISA', 'MASTER'])
            ->nullable(false)
            ->default('TUNAI');
        });
    }
}

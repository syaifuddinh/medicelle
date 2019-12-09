<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('registration_id')->nullable(false)->index();
            $table->string('code', 40)->nullable(true)->index();
            $table->date('date')->nullable(false)->index();
            $table->integer('is_nota_rawat_jalan')->nullable(false)->default(0)->index();
            $table->integer('status')->nullable(false)->default(1)->index();
            $table->integer('qty')->nullable(false)->default(0)->index();
            $table->double('gross')->nullable(false)->default(0)->index();
            $table->double('discount')->nullable(false)->default(0)->index();
            $table->double('netto')->nullable(false)->default(0)->index();
            $table->double('paid')->nullable(false)->default(0)->index();
            $table->double('balance')->nullable(false)->default(0)->index();
            $table->unsignedInteger('discount_id')->nullable(true)->index();
            $table->enum('payment_type', ['BAYAR SENDIRI', 'ASURANSI SWASTA'])->nullable(false);
            $table->enum('payment_method', ['TUNAI', 'KREDIT', 'TT', 'VISA', 'MASTER'])->nullable(false);
            $table->index(['payment_type', 'payment_method']);
            $table->text('description')->nullable(true);
            $table->text('promo_description')->nullable(true);
            $table->dateTime('paid_at')->nullable(true)->index();
            $table->unsignedInteger('paid_by')->nullable(true)->index();
            $table->unsignedInteger('created_by')->nullable(true)->index();
            $table->timestamps();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('registration_id')
              ->references('id')->on('registrations')
              ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}

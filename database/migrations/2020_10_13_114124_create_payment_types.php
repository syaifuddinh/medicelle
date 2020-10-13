<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 15)->nullable(false);
            $table->timestamps();
        });
        $params = [
            [
                'name' => 'TUNAI'
            ],
            [
                'name' => 'KREDIT'
            ],
            [
                'name' => 'TT'
            ],
            [
                'name' => 'VISA'
            ],
            [
                'name' => 'MASTER'
            ],
            [
                'name' => 'DEBIT'
            ]
        ];
        DB::table('payment_types')
        ->insert($params);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_types');
    }
}

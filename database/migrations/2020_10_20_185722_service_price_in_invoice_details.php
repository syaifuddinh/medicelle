<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServicePriceInInvoiceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->double('service_price')->nullable(false)->default(0);
            $table->double('percentage_doctor')->nullable(false)->default(0);
        });
        $invoiceDetails = DB::table('invoice_details')
        ->whereIsItem(1)
        ->get();
        foreach ($invoiceDetails as $invoiceDetail) {
            $item = DB::table('items')
            ->join('prices', 'prices.item_id', 'items.id')
            ->where('items.id', $invoiceDetail->item_id)
            ->select('service_price', 'prices.percentage')
            ->first();
            DB::table('invoice_details')
            ->whereId($invoiceDetail->id)
            ->update([
                'service_price' => $item->service_price ?? 0,            
                'percentage_doctor' => $item->percentage ?? 0
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->dropColumn(['service_price', 'percentage_doctor']);
        });
    }
}

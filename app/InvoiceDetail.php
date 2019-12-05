<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;

class InvoiceDetail extends Model
{
    public static function boot() {
        parent::boot();

        static::creating(function(InvoiceDetail $invoiceDetail){
            $total_debet = $invoiceDetail->qty * $invoiceDetail->debet;
            $total_credit = $invoiceDetail->qty * $invoiceDetail->credit;
            $grandtotal = $total_debet - $total_credit;
            $invoiceDetail->total_debet = $total_debet;
            $invoiceDetail->total_credit = $total_credit;
            $invoiceDetail->grandtotal = $grandtotal;
            $invoice = Invoice::find($invoiceDetail->invoice_id);
            $invoice->increment('total', $grandtotal);
            if($invoiceDetail->is_item == 1) {
                $invoice->increment('qty', 1);
            }
        });
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\Discount;

class InvoiceDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['invoice_id', 'item_id', 'qty', 'debet', 'credit', 'disc_percent'];

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
            $invoice->increment('netto', $grandtotal);
            if($invoiceDetail->is_discount == 1) {
                $invoice->increment('discount', -$grandtotal);                
            } 
            if($invoiceDetail->is_item == 1) {
                $invoice->increment('gross', $grandtotal);                                
                $invoice->increment('qty', 1);
                if($invoice->discount_id != null) {
                    $discountDetail = InvoiceDetail::whereIsDiscount(1)
                    ->whereInvoiceId($invoice->id);
                    $discount = Discount::find($invoice->discount_id);
                    $disc_value = $discount->disc_value;
                    $percent_disc_value = $grandtotal * ($discount->disc_percent / 100);
                    $totalDiscount = $disc_value + $percent_disc_value;
                    if($discountDetail->first() == null) {
                        $discountDetail = new InvoiceDetail();
                        $discountDetail->invoice_id = $invoice->id;
                        $discountDetail->item_id = $invoiceDetail->item_id;
                        $discountDetail->qty = 1;
                        $discountDetail->credit = $totalDiscount;
                        $discountDetail->is_promo = 1;
                        $discountDetail->save();
                    } else {
                        $discountDetail->increment('credit', $totalDiscount);
                    }
                }
            }
            $invoice->balance = $invoice->netto - $invoice->paid;
            $invoice->save();
        });
        static::created(function(InvoiceDetail $invoiceDetail){
            if($invoiceDetail->disc_percent > 0) {
                $total_debet = $invoiceDetail->qty * $invoiceDetail->debet;
                $disc_value = $total_debet * ($invoiceDetail->disc_percent / 100);
                $discountDetail = new InvoiceDetail();
                $discountDetail->invoice_id = $invoiceDetail->invoice_id;
                $discountDetail->item_id = $invoiceDetail->item_id;
                $discountDetail->qty = 1;
                $discountDetail->credit = $disc_value;
                $discountDetail->is_discount = 1;
                $discountDetail->invoice_detail_id = $invoiceDetail->id;
                $discountDetail->save();
            }
        });
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function discount_reference() {
        return $this->belongsTo('App\InvoiceDetail', 'invoice_detail_id', 'id')->whereIsDiscount(1);
    }
    
    public function grup_nota() {
        return $this->hasOneThrough('App\Permission', 'App\Price', 'item_id', 'id', 'item_id', 'grup_nota_id')->where('prices.is_active', 1);
    }
}

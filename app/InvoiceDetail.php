<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\Discount;
use DB;
use Mod;

class InvoiceDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['invoice_id', 'item_id', 'qty', 'debet', 'credit', 'disc_percent', 'is_item', 'is_profit_sharing', 'reduksi', 'is_asuransi'];

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
            if($invoiceDetail->is_discount == 1 || $invoiceDetail->is_discount_total == 1) {
                $invoice->increment('discount', -$grandtotal);                
            } 
            if($invoiceDetail->is_reduksi == 1) {
                $invoice->increment('reduksi', -$grandtotal);                
            } 

            if($invoiceDetail->is_asuransi == 1) {
                $invoice->increment('asuransi_value', $grandtotal);                                
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

            if($invoiceDetail->is_item == 1 && $invoiceDetail->is_profit_sharing == 1) {
                $total_debet = $invoiceDetail->debet;
                $price = DB::table('prices')->whereItemId($invoiceDetail->item_id)->first();
                $percentage = $price->percentage;
                $doctor_allocation = $total_debet * $percentage / 100;
                $owner_allocation = $total_debet * (100 - $percentage) / 100;
                $reduksi_value = $doctor_allocation * $invoiceDetail->reduksi / 100;
                $reduksi_charge = $reduksi_value;

                $reduksiDetail = new InvoiceDetail();
                $reduksiDetail->invoice_id = $invoiceDetail->invoice_id;
                $reduksiDetail->qty = $invoiceDetail->qty;
                $reduksiDetail->credit = $reduksi_charge;
                $reduksiDetail->is_reduksi = 1;
                $reduksiDetail->invoice_detail_id = $invoiceDetail->id;
                $reduksiDetail->save();
            }

            if($invoiceDetail->is_item == 1) {
                $invoice = Invoice::find($invoiceDetail->invoice_id);
                if($invoice->payment_type == 'ASURANSI SWASTA' && $invoice->asuransi_percentage > 0) {

                    $latestAsuransi = InvoiceDetail::whereIsAsuransi(1)->whereInvoiceDetailId($invoiceDetail->id)->first();
                    if($latestAsuransi == null) {

                        $asuransiDetail = new InvoiceDetail();
                        $asuransiDetail->invoice_id = $invoiceDetail->invoice_id;
                        $asuransiDetail->qty = $invoiceDetail->qty;
                        $asuransiDetail->debet = $invoiceDetail->debet * $invoice->asuransi_percentage / 100;
                        $asuransiDetail->is_asuransi = 1;
                        $asuransiDetail->invoice_detail_id = $invoiceDetail->id;
                        $asuransiDetail->save();
                    }
                }
            }

        });
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function discount_reference() {
        return $this->belongsTo('App\InvoiceDetail', 'invoice_detail_id', 'id')->whereIsDiscount(1)->withDefault(['total_credit' => 0, 'credit' => 0]);
    }
    
    public function reduksi_reference() {
        return $this->hasOne('App\InvoiceDetail', 'invoice_detail_id', 'id')->whereIsReduksi(1)->withDefault(['total_credit' => 0, 'credit' => 0]);
    }
    
    public function asuransi_reference() {
        return $this->hasOne('App\InvoiceDetail', 'invoice_detail_id', 'id')->whereIsAsuransi(1)->withDefault(['total_debet' => 0, 'debet' => 0]);
    }
    
    public function price_reference() {
        return $this->belongsTo('App\Price', 'item_id', 'item_id')->whereIsReduksi(1);
    }
    
    public function grup_nota() {
        return $this->hasOneThrough('App\Permission', 'App\Price', 'item_id', 'id', 'item_id', 'grup_nota_id')->where('prices.is_active', 1);
    }
}

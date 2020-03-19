<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\Discount;
use DB;
use Mod;
use Exception;

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
            if($invoiceDetail->is_discount == 1) {
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
                
            }
            $invoice->save();
        });


        static::created(function(InvoiceDetail $invoiceDetail){
            $invoice = Invoice::find($invoiceDetail->invoice_id);

            if($invoiceDetail->disc_percent > 0) {
                $total_debet = $invoiceDetail->qty * $invoiceDetail->debet ;
                $total_debet = $total_debet + ($total_debet * $invoice->asuransi_percentage / 100); 
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
                $current_item = DB::table('items')
                ->whereId($invoiceDetail->item_id)
                ->first();
                if(!$current_item) {
                    throw new Exception('Barang tidak ditemukan');
                } else {
                    if($current_item->is_treatment_group == 1) {
                        $price = DB::table('treatment_groups')->whereItemId($invoiceDetail->item_id)->first();
                    } else {
                        $price = DB::table('prices')->whereItemId($invoiceDetail->item_id)->first();
                    }
                }

                $percentage = $price->percentage ?? 0;
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
                // Menghitung kenaikan harga asuransi
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
            
            if($invoiceDetail->is_item == 1 || $invoiceDetail->is_discount == 1 || $invoiceDetail->is_asuransi == 1) {


                // Menghitung diskon total
                if($invoice->discount_total_percentage > 0) {
                    if($invoiceDetail->is_item == 1 || $invoiceDetail->is_asuransi == 1) {
                        $subtotal = $invoiceDetail->total_debet;
                        
                    } else if($invoiceDetail->is_discount == 1) {
                        $subtotal = -1 * $invoiceDetail->total_credit;
                    }
                    $subtotal = $subtotal * $invoice->discount_total_percentage / 100;
                    $latestDiscountTotal = InvoiceDetail::whereInvoiceId($invoiceDetail->invoice_id)
                                    ->whereIsDiscountTotal(1);
                    $detail = $latestDiscountTotal->first();
                    if($latestDiscountTotal->first() == null) {
                        $discountTotalDetail = new InvoiceDetail();
                        $discountTotalDetail->invoice_id = $invoice->id;
                        $discountTotalDetail->qty = 1;
                        $discountTotalDetail->credit = $subtotal;
                        $discountTotalDetail->is_discount_total = 1;
                        $discountTotalDetail->save();

                    } else {
                        $credit = $detail->credit;
                        $total_credit = $detail->total_credit;
                        $grandtotal = $detail->grandtotal;
                        $latestDiscountTotal->update([
                            'credit' => $credit + $subtotal,
                            'total_credit' => $total_credit + $subtotal,
                            'grandtotal' => $grandtotal - $subtotal,
                        ]);

                    }

                    $invoice->discount_total_value = $invoice->discount_total_value - $subtotal;
                        $invoice->save(); 

                }
                
                // Menghitung promo
                if($invoice->discount_id != null) {
                    if($invoiceDetail->is_item == 1 || $invoiceDetail->is_asuransi == 1) {
                        $subtotal = $invoiceDetail->total_debet;
                    } else if($invoiceDetail->is_discount == 1) {
                        $subtotal = -$invoiceDetail->total_credit;
                    }


                    $promoDetail = InvoiceDetail::whereIsPromo(1)
                    ->whereInvoiceId($invoice->id);
                    $promo = $promoDetail->first();
                    $discount = Discount::find($invoice->discount_id);
                    $disc_value = $discount->disc_value;
                    $percent_disc_value = $subtotal * ($discount->disc_percent / 100);
                    $totalDiscount = $percent_disc_value;
                    if($promoDetail->first() == null) {
                        $totalDiscount = $percent_disc_value + $disc_value;

                        $promoDetail = new InvoiceDetail();
                        $promoDetail->invoice_id = $invoice->id;
                        $promoDetail->qty = 1;
                        $promoDetail->credit = $totalDiscount;
                        $promoDetail->is_promo = 1;
                        $promoDetail->save();
                    } else {
                        $credit = $promo->credit;
                        $total_credit = $promo->total_credit;
                        $grandtotal = $promo->grandtotal;
                        $promoDetail->update([
                            'credit' => $credit + $totalDiscount,
                            'total_credit' => $total_credit + $totalDiscount,
                            'grandtotal' => $grandtotal - $totalDiscount,
                        ]);
                    }
                }

            }

            $summaryInvoiceDetail = InvoiceDetail::whereInvoiceId($invoiceDetail->invoice_id)->sum('grandtotal');
            $invoice->netto = $summaryInvoiceDetail;
            $invoice->save();
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

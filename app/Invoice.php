<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Mod;
use DB;

class Invoice extends Model
{
    protected $hidden = ['updated_at'];
    protected $fillable = ['discount_id', 'code', 'registration_id', 'date', 'description', 'promo_description', 'payment_method', 'payment_type', 'paid', 'invoice_amandemen_id', 'status'];
    protected $appends = ['status_name'];

    public static function boot() {
        parent::boot();

        static::updating(function(Invoice $invoice) {
            $invoice->balance = $invoice->netto - $invoice->paid;
            if($invoice->payment_type == 'ASURANSI SWASTA') {
                $invoice->asuransi_percentage = Mod::finance()->asuransi_rate_percentage ?? 0;
            } else {
                $invoice->asuransi_percentage = 0;
            }

            if($invoice->status != 1 && $invoice->status != 5) {
                if($invoice->paid_at == null && $invoice->paid_by == null) {
                    $invoice->paid_at = date('Y-m-d H:i:s');
                    $invoice->paid_by = Auth::user()->id;
                }
                if($invoice->balance == 0) {
                    $invoice->status = 3;
                } else {
                    if($invoice->balance < 0) {
                        $invoice->status = 4;                    
                    } else {
                        $invoice->status = 2;                    
                    }
                }
            }
        });

        static::creating(function(Invoice $invoice) {
            $invoice->created_by = Auth::user()->id;
            $invoice->date = date('Y-m-d');

            // Generate code
            $current_month = date('m');
            $current_year = date('Y');
            $id = DB::table('invoices')
            ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
            ->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 5, '0', STR_PAD_LEFT);
            $code = 'NJ-' . date('dm') . '-' . $id;

            $invoice->code = $code;
        });

    }

    public function getStatusNameAttribute() {
        if(!array_key_exists('status', $this->attributes)) {
            return null;
        } else {
            if($this->attributes['status'] == 1) {
                return 'Belum terbayar';
            } else if($this->attributes['status'] == 2) {
                return 'Belum lunas';
            } else if($this->attributes['status'] == 3) {
                return 'Lunas';
            } else if($this->attributes['status'] == 4) {
                return 'Lebih bayar';
            } else if($this->attributes['status'] == 5) {
                return 'Amandemen';
            } else {
                return null;
            }
        }
    }

    public function setMassiveDiscountAttribute($value) {
        $this->child()->create([
            'qty' => 1,
            'credit' => $value ?? 0,
            'is_discount_total' => 1
        ]);
    }

    public function registration() {
        return $this->belongsTo('App\Registration');
    }
    public function promo() {
        return $this->hasOne('App\InvoiceDetail', 'invoice_id', 'id')->whereIsPromo(1)->withDefault(['credit' => 0, 'total_credit' => 0]);
    }
    public function massive_discount() {
        return $this->hasOne('App\InvoiceDetail', 'invoice_id', 'id')->whereIsDiscountTotal(1)->withDefault(['total_credit' => 0]);
    }
    public function promo_info() {
        return $this->belongsTo('App\Discount', 'discount_id', 'id');
    }
    public function teller() {
        return $this->belongsTo('App\User', 'paid_by', 'id')->withDefault(['name' => '-']);
    }
    public function detail() {
        return $this->hasMany('App\InvoiceDetail')->whereIsItem(1);
    }
    public function child() {
        return $this->hasMany('App\InvoiceDetail');
    }
    public function amandemen_to() {
        return $this->hasOne('App\Invoice', 'invoice_amandemen_id', 'id');
    }
    public function amandemen_by() {
        return $this->belongsTo('App\Invoice', 'invoice_amandemen_id', 'id');
    }
}

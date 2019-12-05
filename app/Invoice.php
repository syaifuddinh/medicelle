<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $hidden = ['updated_at'];
    protected $guarded = ['id'];
    protected $appends = ['status_name'];

    public static function boot() {
        parent::boot();

        static::updating(function(Invoice $invoice) {
            if($invoice->status == 2) {
                if($invoice->paid_at == null && $invoice->paid_by == null) {
                    $invoice->paid_at = date('Y-m-d H:i:s');
                    $invoice->paid_by = Auth::user()->id;
                }
            }
        });

    }

    public function getStatusNameAttribute() {
        if(!array_key_exists('status', $this->attributes)) {
            return null;
        } else {
            if($this->attributes['status'] == 1) {
                return 'Belum terbayar';
            } else if($this->attributes['status'] == 2) {
                return 'Terbayar';
            } else {
                return null;
            }
        }
    }

    public function registration() {
        return $this->belongsTo('App\Registration');
    }
}

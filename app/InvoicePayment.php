<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['invoice_id', 'price', 'method'];
}

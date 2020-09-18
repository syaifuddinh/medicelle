<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\PurchaseOrder;
use App\PurchaseRequestDetail;
use DB;
use Carbon\Carbon;

class PurchaseRequestLog extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    } 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\PurchaseOrder;
use App\PurchaseRequestDetail;
use DB;
use Carbon\Carbon;
use App\Notification;
use Mod;

class PurchaseRequest extends Model
{
    protected $fillable = ['date', 'date_start', 'date_end', 'description'];
    protected $appends = ['status_name'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(PurchaseRequest $purchaseRequest) {   
            $current_month = date('m');
            $current_year = date('Y');
            $id = PurchaseRequest::whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
            ->max('code');
            $id_in = intval(substr($id, -5)) + 1;
            $id = $id == null ? 1 : $id_in;
            $id = str_pad($id, 5, '0', STR_PAD_LEFT);
            $code = 'PP-' . date('ym') . '-' .  $id;
            $purchaseRequest->created_by = Auth::user()->id;
            $purchaseRequest->code = $code;
        });

        static::created(function(PurchaseRequest $purchaseRequest) {   
            $existing = DB::table('purchase_request_logs')
            ->wherePurchaseRequestId($purchaseRequest->id)
            ->whereStatus($purchaseRequest->status)
            ->count('id');
            if($existing == 0) {
                $params = [];
                $params['created_by'] = auth()->user()->id;
                $params['purchase_request_id'] = $purchaseRequest->id;
                $params['status'] = $purchaseRequest->status;
                $params['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
                DB::table('purchase_request_logs')
                ->insert($params);

                // Buat notifikasi
                $n = new Notification();
                $n->user_id = auth()->user()->id;
                $n->title = 'Permintaan pembelian #' . $purchaseRequest->code . ' baru dibuat';
                $n->description = 'Permintaan pembelian #' . $purchaseRequest->code . ' telah dibuat pada Tanggal ' . Mod::fullDate($purchaseRequest->created_at);
                $n->route = 'pharmacy.purchase_request.show';
                $n->param = '{"id" : ' . $purchaseRequest->id . '}';
                $n->save();
            }
        });

        static::updating(function(PurchaseRequest $purchaseRequest) {   
            if($purchaseRequest->status == 4) {
                $existing_po = PurchaseOrder::wherePurchaseRequestId($purchaseRequest->id)
                ->count('id');

                if($existing_po == 0) {
                    PurchaseRequest::createPurchaseOrder($purchaseRequest);
                }
            }

            $existing = DB::table('purchase_request_logs')
            ->wherePurchaseRequestId($purchaseRequest->id)
            ->whereStatus($purchaseRequest->status)
            ->count('id');
            if($existing == 0) {
                $params = [];
                $params['created_by'] = auth()->user()->id;
                $params['purchase_request_id'] = $purchaseRequest->id;
                $params['status'] = $purchaseRequest->status;
                $params['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
                DB::table('purchase_request_logs')
                ->insert($params);
            }
        });
    }

    public function getStatusNameAttribute() {
        $setting = \App\Http\Controllers\User\SettingController::fetch('purchase_request');
        if(array_key_exists('status', $this->attributes)) {
            $status = $setting->status ?? [];
            $status = collect($status)->firstWhere('id', $this->attributes['status']);
            return $status->name ?? '';
        } else {
            return '';
        }
    } 

    public static function createPurchaseOrder($purchaseRequest) {
        $suppliers = PurchaseRequestDetail::wherePurchaseRequestId($purchaseRequest->id)
                    ->select('supplier_id')->groupBy('supplier_id')->get();

	foreach($suppliers as $supplier){
                $purchaseOrder = new PurchaseOrder();
                $purchaseOrder->purchase_request_id = $purchaseRequest->id;
                $purchaseOrder->description = $purchaseRequest->description;
                $purchaseOrder->date = date('Y-m-d');
                $purchaseOrder->date_start = $purchaseRequest->date_start;
                $purchaseOrder->date_end = $purchaseRequest->date_end;
                $purchaseOrder->supplier_id = $supplier->supplier_id;
                $purchaseOrder->save();

		$details = DB::table('purchase_request_details')->whereSupplierId($supplier->supplier_id)->wherePurchaseRequestId($purchaseRequest->id)
                ->get();

        	foreach ($details as $detail) {
                	$purchaseOrder->detail()->create([
                    	'item_id' => $detail->item_id,
                    	'qty' => $detail->qty,
                    	'used_qty' => $detail->used_qty,
                    	'stock_qty' => $detail->stock_qty,
                    	//'leftover_qty' => $detail->qty,
                    	'purchase_price' => $detail->purchase_price,
                    	'discount' => $detail->discount,
                    	'discount_off' => $detail->discount_off
                	]);
       		}
	}
    }

    public function detail() {
        return $this->hasMany('App\PurchaseRequestDetail');
    } 
    public function purchase_order() {
        return $this->hasMany('App\PurchaseOrder');
    } 

    public function draft() {
        return $this->hasOne('App\PurchaseRequestLog')
        ->whereStatus(1);
    } 

    public function apj() {
        return $this->hasOne('App\PurchaseRequestLog')
        ->whereStatus(2);
    } 

    public function direktur() {
        return $this->hasOne('App\PurchaseRequestLog')
        ->whereStatus(3);
    } 

    public function approved() {
        return $this->hasOne('App\PurchaseRequestLog')
        ->whereStatus(4);
    } 
}

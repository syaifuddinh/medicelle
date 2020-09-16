<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\PurchaseOrder;
use App\PurchaseRequestDetail;
use DB;

class PurchaseRequest extends Model
{
    protected $fillable = ['date', 'date_start', 'date_end', 'description'];
    protected $appends = ['status_name'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(PurchaseRequest $purchaseRequest) {   


            $purchaseRequest->created_by = Auth::user()->id;

            $current_month = date('m');
            $current_year = date('Y');
            $id = PurchaseRequest::whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
            ->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 5, '0', STR_PAD_LEFT);
            $code = 'PP-' . date('ym') . '-' .  $id;

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
                $params['created_at'] = date('Y-m-d');
                DB::table('purchase_request_logs')
                ->insert($params);
            }
        });

        static::updating(function(PurchaseRequest $purchaseRequest) {   
            if($purchaseRequest->status == 4) {
                $existing_po = PurchaseOrder::wherePurchaseRequestId($purchaseRequest->id)
                ->count('id');

                if($existing_po == 0) {
                    $details = PurchaseRequestDetail::wherePurchaseRequestId($purchaseRequest->id)
                    ->get();
                    foreach ($details as $detail) {
                        $existing_po = PurchaseOrder::wherePurchaseRequestId($purchaseRequest->id)
                        ->whereSupplierId($detail->supplier_id);

                        if($existing_po->count('id') < 1) {
                            $purchaseOrder = new PurchaseOrder();
                            $purchaseOrder->purchase_request_id = $purchaseRequest->id;
                            $purchaseOrder->description = $purchaseRequest->description;
                            $purchaseOrder->date = date('Y-m-d');
                            $purchaseOrder->date_start = $purchaseRequest->date_start;
                            $purchaseOrder->date_end = $purchaseRequest->date_end;
                            $purchaseOrder->supplier_id = $detail->supplier_id;
                            $purchaseOrder->save();

                            $purchaseOrder->detail()->create([
                                'item_id' => $detail->item_id,
                                'qty' => $detail->qty,
                                'leftover_qty' => $detail->qty,
                                'purchase_price' => $detail->purchase_price,
                                'discount' => $detail->discount
                            ]);
                        } else {
                            $existing_po = PurchaseOrder::wherePurchaseRequestId($purchaseRequest->id)
                            ->whereSupplierId($detail->supplier_id);
                            $id = $existing_po->first()->id;
                            $purchaseOrder = PurchaseOrder::find($id);
                            $purchaseOrder->detail()->create([
                                'item_id' => $detail->item_id,
                                'qty' => $detail->qty,
                                'leftover_qty' => $detail->qty,
                                'purchase_price' => $detail->purchase_price,
                                'discount' => $detail->discount
                            ]);
                        }
                    }


                }
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

    public function detail() {
        return $this->hasMany('App\PurchaseRequestDetail');
    } 
    public function purchase_order() {
        return $this->hasMany('App\PurchaseOrder');
    } 
}

<?php

namespace App\Http\Controllers\User;

use App\Price;
use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Response;
use DB;
use Str;
use Auth;
use Exception;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price = Price::select('id', 'name')
        ->whereIsActive(1)
        ->whereIsGrupNota(1)
        ->get();
        return Response::json($price, 200);
    }

    public function treatment()
    {
        $item = Item::with('price:item_id,destination')->select('id', 'name', 'category_id')
        ->whereIsCategory(0)
        ->whereIsActive(1)
        ->whereIsAdministration(1)
        ->whereHas('price', function(Builder $query) {
            $query->whereIsTreatment(1);

            if(Auth::user()->is_admin != 1) {
                $contact = Auth::user()->contact;
                if($contact != null) {
                    if($contact->is_doctor == 1 || $contact->is_nurse == 1 || $contact->is_nurse_helper == 1 ) {
                        $specialization = $contact->specialization;
                        $roles = $specialization->grup_nota_roles;
                        $query->whereIn('destination', $roles);
                    }
                }
            } 
        })
        ->get();
        return Response::json($item, 200);
    }

    public function diagnostic()
    {
        $item = Item::with('price:item_id,destination')->select('id', 'name', 'category_id')
        ->whereIsCategory(0)
        ->whereIsActive(1)
        ->whereIsAdministration(1)
        ->whereHas('price', function(Builder $query) {
            $query->whereIsDiagnostic(1);

            if(Auth::user()->is_admin != 1) {
                $contact = Auth::user()->contact;
                if($contact != null) {
                    if($contact->is_doctor == 1 || $contact->is_nurse == 1 || $contact->is_nurse_helper == 1 ) {
                        $specialization = $contact->specialization;
                        $roles = $specialization->grup_nota_roles;
                        $query->whereIn('destination', $roles);
                    }
                }
            } 
        })
        ->get();
        return Response::json($item, 200);
    }

    public function destination() {
        $destination = ['POLIKLINIK', 'MEDICAL CHECK-UP', 'LABORATORIUM', 'RADIOLOGI', 'KEMOTERAPI', 'RUANG TINDAKAN'];

        return Response::json($destination);
    }

    public function drug()
    {
        $stocks = DB::table('stocks')
        ->select('item_id', DB::raw('SUM(qty) AS qty'))
        ->whereRaw("(DATE_PART('DAY', NOW() - expired_date)) < -7")
        ->groupBy('item_id');
        $item = Item::with('piece:id,name', 'generic:id,name')
        ->leftJoinSub($stocks, 'stocks', function($join){
            $join->on('stocks.item_id', 'items.id');
        })
        ->select('id', 'name', 'piece_id', 'generic_id', DB::raw('COALESCE(stocks.qty, 0) AS qty'))
        ->whereIsCategory(0)
        ->whereIsClassification(0)
        ->whereIsSubclassification(0)
        ->whereIsGeneric(0)
        ->whereNotNull('category_id')
        ->whereIsActive(1)
        ->whereIsCure(1)
        ->get();
        return Response::json($item, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function save($request) {
        $price = new Price();
        $price->fill($request->all());
        $item = new Item();
        $item->is_administration = 1;
        $item->name = $request->name;
        $item->piece_id = $request->piece_id;
        $item->code = date('ym') . rand(1, 999);
        $item->price = $request->price;
        $item->save();
        $price->item_id = $item->id;
        $price->custom_price = $request->price;
        $price->save();
        if($request->filled('laboratory_types')) {
            foreach ($request->laboratory_types as $value) {
                if(1 == ($value['is_active'] ?? null)) {

                    $price->laboratory_treatment()->create([
                        'laboratory_type_id' => $value['id']
                    ]);
                }
            }
        }

        return $price->id;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'grup_nota_id' => 'required',
        ], [
            'grup_nota_id.required' => 'Grup nota tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            $this->save($request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return Response::json(['message' => $e->getMessage()], 421);
        }
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $price = Price::with('grup_nota:id,slug,name', 'radiology_type:id,name', 'service:id,name,price,piece_id', 'service.piece:id,name', 'polyclinic:id,name', 'laboratory_treatment', 'laboratory_treatment.laboratory_type:id,name', 'specialization:id,name');
        return Response::json($price->find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    public function put($id, $request) {
        $price = Price::find($id);
        $price->fill($request->all());
        $item = Item::find($price->item_id);
        $item->name = $request->name;
        $item->piece_id = $request->piece_id;
        $item->price = $request->price;
        $item->save();
        $price->custom_price = $request->price;
        $price->save();
        if($request->filled('laboratory_types')) {
            $price->laboratory_treatment()->delete();
            foreach ($request->laboratory_types as $value) {
                if(1 === ($value['is_active'] ?? null)) {

                    $price->laboratory_treatment()->create([
                        'laboratory_type_id' => $value['id']
                    ]);
                }
            }
        }
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            'grup_nota' => 'required',
            'name' => 'required',
            'price' => 'required'
        ], [
            'grup_nota.required' => 'Grup nota tidak boleh tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            $this->put($id, $request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return Response::json(['message' => $e->getMessage()], 421);
        }

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $price = Price::find($id);
        $price->is_active = 0;
        $price->service()->update([
            'is_active' => 0
        ]);
        $price->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate($id)
    {
        DB::beginTransaction();
        $price = Price::find($id);
        $price->is_active = 1;
        $price->service()->update([
            'is_active' => 1
        ]);
        $price->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}

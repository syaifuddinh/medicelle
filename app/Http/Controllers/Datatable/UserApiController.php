<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\Notification;
use App\User;
use App\Item;
use App\Price;
use App\LaboratoryType;
use Illuminate\Database\Eloquent\Builder;
use DataTables;
use Auth;

class UserApiController extends Controller
{
    public function notification(Request $request) {
        $x = Notification::select('id', 'title', 'description', 'is_read')->whereUserId( Auth::user()->id );
        $x = $request->filled('is_read') ? $x->whereIsRead($request->is_read) : $x;
        $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function group_user(Request $request) {
        $x = Permission::select('id', 'name', 'is_active', 'description')->whereIsPermission(1);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function grup_nota(Request $request) {
        $x = Permission::select('id', 'name', 'slug', 'is_active', 'description')->whereIsGrupNota(1);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function signa(Request $request) {
        $x = Permission::select('id', 'name', 'description', 'is_active', 'description')->whereIsSigna(1);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function laboratory_type(Request $request) {
        $x = LaboratoryType::select('id', 'name', 'is_active');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function user(Request $request) {
        $x = User::with('group_user')->select('id', 'code', 'name', 'is_active', 'group_user_id');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->filled('group_user_id')) {
            $x = $x->whereGroupUserId($request->group_user_id);
        }
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
    public function price(Request $request) {
        $x = Price::with('service:id,name,price', 'grup_nota:id,slug', 'polyclinic:id,name')
        ->where('destination', '!=', 'OBAT')
        ->where('destination', '!=', 'BHP')
        ->orWhere('destination', '=', null)
        ->select('prices.id', 'destination', 'prices.polyclinic_id', 'prices.is_registration', 'prices.is_sewa_ruangan', 'prices.is_sewa_alkes', 'prices.item_id', 'prices.grup_nota_id', 'prices.is_active');
        $x = $request->filled('is_active') ? $x->where('prices.is_active', $request->is_active) : $x;

        if($request->filled('search')) {
            $x = $x->whereHas('service', function(Builder $query) use($request){
                $query->whereRaw("name LIKE '%" . $request->search['value'] . "%'");
            });
        }

        if($request->draw == 1)
            $x->orderBy('prices.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
}

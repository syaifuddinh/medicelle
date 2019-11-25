<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Specialization;
use App\Polyclinic;
use App\Piece;
use App\Discount;
use App\Contact;
use DataTables;

class MasterApiController extends Controller
{
    public function specialization(Request $request) {
        $x = Specialization::select('id', 'name', 'is_active', 'code');
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function polyclinic(Request $request) {
        $x = Polyclinic::select('id', 'name', 'is_active', 'code', 'index', 'cost_center');
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function piece(Request $request) {
        $x = Piece::select('id', 'name', 'is_active');
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }


    public function doctor(Request $request) {
        $x = Contact::doctor()->with('specialization', 'polyclinic', 'city')->select('id', 'code', 'name', 'specialization_id', 'city_id', 'polyclinic_id', 'phone', 'is_active');

        if($request->filled('polyclinic_id')) {
            $x = $x->wherePolyclinicId($request->polyclinic_id);
        }
        if($request->filled('specialization_id')) {
            $x = $x->whereSpecializationId($request->specialization_id);
        }
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function nurse(Request $request) {
        $x = Contact::nurse()->with('specialization', 'group_user', 'city')->select('id', 'code', 'name', 'specialization_id', 'city_id', 'group_user_id', 'phone', 'is_active');

        if($request->filled('group_user_id')) {
            $x = $x->whereGroupUserId($request->group_user_id);
        }
        if($request->filled('specialization_id')) {
            $x = $x->whereSpecializationId($request->specialization_id);
        }
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function nurse_helper(Request $request) {
        $x = Contact::nurse_helper()->with('specialization', 'group_user', 'city')->select('id', 'code', 'name', 'specialization_id', 'city_id', 'group_user_id', 'phone', 'is_active');

        if($request->filled('group_user_id')) {
            $x = $x->whereGroupUserId($request->group_user_id);
        }
        if($request->filled('specialization_id')) {
            $x = $x->whereSpecializationId($request->specialization_id);
        }
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function discount(Request $request) {
        $x = Discount::select('id', 'name', 'is_active', 'code', 'date_start', 'date_end' ,'type')
        ->whereBetween('date_start', [$request->date_start, $request->date_end])
        ->WhereBetween('date_end', [$request->date_start, $request->date_end])
        ;

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function supplier(Request $request) {
        $x = Contact::supplier()->with('city', 'contact:id,name')->select('id', 'code', 'name', 'city_id', 'phone', 'contact_id', 'fax', 'is_active');

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function agency(Request $request) {
        $x = Contact::agency()->with('city', 'contact:id,name')->select('id', 'code', 'name', 'city_id', 'phone', 'contact_id', 'agency_type', 'is_active');

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function employee(Request $request) {
        $x = Contact::employee()->with('city', 'group_user:id,name')->select('id', 'code', 'name', 'city_id', 'pin', 'phone', 'group_user_id', 'is_active');

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
}

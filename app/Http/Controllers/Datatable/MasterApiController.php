<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Specialization;
use App\Polyclinic;
use App\Piece;
use App\Discount;
use App\Contact;
use App\Item;
use App\Permission;
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

    public function lokasi(Request $request) {
        $x = Permission::whereIsLokasi(1)
        ->select('id', 'name', 'description', 'is_active');
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function doctor(Request $request) {
        $x = Contact::doctor()->with('specialization', 'polyclinic', 'city')->select('id', 'code', 'name', 'specialization_id', 'city_id', 'polyclinic_id', 'phone', 'is_active');

        if($request->filled('polyclinic_id')) {
            $x = $x->wherePolyclinicId($request->polyclinic_id);
        }
        if($request->filled('current_id')) {
            $x = $x->where('contacts.id', '!=', $request->current_id);  
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

    public function actived_discount(Request $request) {
        $currentDate = date('Y-m-d');
        $x = Discount::select('id', 'name', 'is_active', 'code', 'date_start', 'date_end' ,'type', 'disc_percent', 'disc_value')
        ->whereRaw("'$currentDate' BETWEEN date_start AND date_end")
        ->whereIsActive(1);
        // die($request->is_active);
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function discount(Request $request) {
        $x = Discount::select('id', 'name', 'is_active', 'code', 'date_start', 'date_end' ,'type')
        ->whereBetween('date_start', [$request->date_start, $request->date_end])
        ->WhereBetween('date_end', [$request->date_start, $request->date_end]);

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function supplier(Request $request) {
        $x = Contact::supplier()->with('city', 'contact:id,name')->select('contacts.id', 'contacts.code', 'contacts.name', 'contacts.city_id', 'contacts.phone', 'contacts.contact_id', 'contacts.fax', 'contacts.is_active');

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function agency(Request $request) {
        $x = Contact::agency()->with('city', 'contact:id,name')->select('contacts.id', 'contacts.code', 'contacts.name', 'contacts.city_id', 'contacts.phone', 'contacts.contact_id', 'contacts.agency_type', 'contacts.is_active');

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        $x = $request->filled('agency_type') ? $x->whereAgencyType($request->agency_type) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function employee(Request $request) {
        $x = Contact::employee()->with('city', 'group_user:id,name')->select('contacts.id', 'contacts.code', 'contacts.name', 'city_id', 'pin', 'phone', 'group_user_id', 'is_active');

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->order[0]['column'] == 0) {
            $x->orderBy('contacts.id', $request->order[0]['dir']);
        }

        return Datatables::eloquent($x)->make(true);
    }

    public function patient(Request $request) {
        if($request->filled('is_display_all')) {
            if($request->is_display_all == 1) {
                $x = Contact::patient()->with('city:id,name', 'family:id,name,address,job');
            }
        } else {
            $x = Contact::patient()->select('id', 'civil_code', 'phone', 'name', 'age', 'gender', 'is_active', 'birth_date');
        }

        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;

        if($request->order[0]['column'] == 0) {
            $x->orderBy('id', $request->order[0]['dir']);
        }

        return Datatables::eloquent($x)->make(true);
    }

    public function disease_category(Request $request) {
        $x = Item::disease_category()->select('id', 'code', 'name', 'description', 'is_active');
        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function disease(Request $request) {
        $x = Item::disease()
        ->has('category')
        ->with('category:id,code,name')
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id');
        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function administration(Request $request) {
        $x = Item::administration()
        ->with('administration_category:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug')
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id');
        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function laboratory(Request $request) {
        $x = Item::laboratory()
        ->with('laboratory_category:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug')
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id');
        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function radiology(Request $request) {
        $x = Item::radiology()
        ->with('laboratory_category:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug')
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id');
        // die($request->is_active);
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function cure(Request $request) {
        $x = Item::cure()
        ->with('group:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug')
        ->whereIsCategory(0)
        ->whereIsClassification(0)
        ->whereIsSubclassification(0)
        ->whereIsGeneric(0)
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function obat(Request $request) {
        $x = Item::cure()
        ->with('group:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,name')
        ->whereIsCategory(0)
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id', 'items.classification_id', 'items.subclassification_id', 'items.generic_id', 'is_cure');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function item(Request $request) {
        $x = Item::with('piece:id,name')
        ->whereRaw('(is_cure = 1 OR is_medical_item = 1) AND (is_category = 0 AND is_classification = 0 AND is_subclassification = 0 AND is_generic = 0)')
        ->select('items.id', 'items.code', 'items.name', 'items.category_id', 'items.classification_id', 'items.subclassification_id', 'items.generic_id', 'items.price', 'items.piece_id');

        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function medical_item(Request $request) {
        $x = Item::medical_item()
        ->with('group:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug')
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function bhp(Request $request, $flag = '') {
        $x = Item::bhp()
        ->with('group:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug', 'piece:id,name')
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id', 'items.piece_id');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');
        if($flag == 'actived') {
            $x->whereIsCategory(0)->whereIsActive(1);
        }

        return Datatables::eloquent($x)->make(true);
    }

    public function sewa_alkes(Request $request, $flag = '') {
        $x = Item::with('group:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug', 'piece:id,name')
        ->whereHas('price', function(Builder $query) use($request){
            $query->whereIsSewaAlkes(1);
        })
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id', 'items.piece_id');
        $x = $request->filled('items.is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');
        if($flag == 'actived') {
            $x->whereIsCategory(0)->whereIsActive(1);
        }

        return Datatables::eloquent($x)->make(true);
    }

    public function sewa_ruangan(Request $request, $flag = '') {
        $x = Item::with('group:id,code,name', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug', 'piece:id,name')
        ->whereHas('price', function(Builder $query) use($request){
            $query->whereIsSewaRuangan(1);
        })
        ->select('items.id', 'items.code', 'items.name', 'items.description', 'items.is_active', 'items.category_id', 'items.piece_id');
        $x = $request->filled('items.is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');
        if($flag == 'actived') {
            $x->whereIsCategory(0)->whereIsActive(1);
        }

        return Datatables::eloquent($x)->make(true);
    }
}

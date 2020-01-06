<?php

namespace App\Http\Controllers\Master;

use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sewa_alkes()
    {
        $item = Item::sewa_alkes()->has('category')->with('category:id,name')->select('id', 'code', 'name', 'category_id')->get();
        return Response::json($item, 200);
    }

}

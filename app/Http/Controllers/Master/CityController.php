<?php

namespace App\Http\Controllers\Master;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $x = City::with('province')->get();
        return Response::json($x, 200);
    }

    public function province()
    {
        $x = DB::table('provinces')->select('id', 'name')->get();
        return Response::json($x, 200);
    }
}

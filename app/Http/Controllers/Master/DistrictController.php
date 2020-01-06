<?php

namespace App\Http\Controllers\Master;

use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $x = District::select('id', 'name', 'city_id')->get();
        return Response::json($x, 200);
    }
}

<?php

namespace App\Http\Controllers\Master;

use App\Village;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $x = Village::select('id', 'name', 'district_id')->get();
        return Response::json($x, 200);
    }
}

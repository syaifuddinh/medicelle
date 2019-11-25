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
        $contact = City::with('province')->get();
        return Response::json($contact, 200);
    }
}

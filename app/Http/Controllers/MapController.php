<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function maps()
    {
        return view('map');
    }
    public function getBusLocation()
    {
        $data = DB::table('bus')
            ->select(
                'bus_number',
                'route_name',
                'latitude',
                'longitude'
            )
            ->get();

        return response()->json($data);
    }

    public function getStops()
{
    $stops = DB::table('stop')
        ->select(
            'stop_name',
            'route_name',
            'latitude',
            'longitude'
        )
        ->get();

    return response()->json($stops);
}
}

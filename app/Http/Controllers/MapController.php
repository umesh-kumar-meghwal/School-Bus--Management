<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function maps(Request $request)
    {
        $school_email = $request->q;
        $school_name = DB::table('school')->where('school_email',Crypt::decryptString($school_email))->first()->school_name;
        return view('map',compact('school_email','school_name'));
    }
    public function getBusLocation(Request $request)
    {
        $school_email = Crypt::decryptString($request->input('school_email'));
        $data = DB::table('bus')->where('school_email', $school_email)
            ->select(
                'bus_number',
                'route_name',
                'latitude',
                'longitude'
            )
            ->get();

        return response()->json($data);
    }

    public function getStops(Request $request)
    {
        $school_email = Crypt::decryptString($request->input('school_email'));

        $stops = DB::table('stop')->where('school_email', $school_email)
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

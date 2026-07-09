<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class RouteController extends Controller
{
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email =$request->q;
            return view('addroute',compact('school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function store(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $rt_name = $request->route_name;
            $data = DB::table('route')->where('route_name', $rt_name)->first();
            Route::create([
                'route_name' => $request->route_name,
                'start_point' => $request->start_point,
                'start_time' => $request->start_time,
                'end_point' => $request->end_point,
                'end_time' => $request->end_time,
                'distance' => $request->distance,
                'estimated_time' => $request->estimated_time,
                'status' => $request->status,
                'school_email'=>Crypt::decryptString($request->school_email)
            ]);
            $msg = "Route Successfully Registered";
            $school_email = $request->school_email;
            return view('addroute', compact('msg','school_email'));
        } else {
            return redirect('/error');
        }
    }
}

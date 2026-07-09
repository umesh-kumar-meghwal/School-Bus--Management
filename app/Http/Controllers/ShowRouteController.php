<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Student;
use App\Models\Stop;

use App\Models\Bus;

class ShowRouteController extends Controller
{
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == "admin" || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('route')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('route-show', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $id = $request->id;
            $data = DB::table('route')->where('id', $id)->first();
            return view('route-edit', compact('data'));
        } else {
            return redirect('/error');
        }
    }

    public function save(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $id = $request->id;
            Route::where('id', $id)->update([
                'route_name' => $request->route_name,
                'start_point' => $request->start_point,
                'start_time' => $request->start_time,
                'end_point' => $request->end_point,
                'end_time' => $request->end_time,
                'distance' => $request->distance,
                'estimated_time' => $request->estimated_time,
                'status' => $request->status
            ]);
            $school_email = $request->school_email;
            $data = DB::table('route')->where('school_email', Crypt::decryptString($request->school_email))->get();
            return view('route-show', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $route = Route::where('id', $request->id)->first();
            $school_email = $request->school_email;
            if ($route) {
                $route_name = $route->route_name;
                Student::where('school_name',Crypt::decryptString($school_email))->where('route_name', $route_name)->update(['route_name' => null, 'stop_name' => null]);
                Bus::where('school_name',Crypt::decryptString($school_email))->where('route_name', $route_name)->delete();
                $stop = Stop::where('school_name',Crypt::decryptString($school_email))->where('route_name', $route_name);
                $stop->delete();
                $route->delete();
            }
            $data = DB::table('route')->where('school_email', Crypt::decryptString($request->school_email))->get();
            return view('route-show', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Student;
use App\Models\Stop;

use App\Models\Bus;

class ShowRouteController extends Controller
{
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == "admin" || $usertype =='school') {
            $data = DB::table('route')->get();
            return view('route-show', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $id = $request->id;
            $data = DB::table('route')->where('id', $id)->first();
            return view('route-edit', compact('data'));
        }else {
            return redirect('/error');
        }
    }

    public function save(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $id = $request->id;
            Route::where('id', $id)->update([
                'route_name' => $request->route_name,
                'start_point' => $request->start_point,
                'end_point' => $request->end_point,
                'distance' => $request->distance,
                'status' => $request->status
            ]);
            return redirect('/showroute');
        }else {
            return redirect('/error');
        }
    }

    public function delete(Request $request)
    {
         $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $route = Route::where('id', $request->id)->first();
            if ($route) {
                $route_name = $route->route_name;
                Student::where('route_name', $route_name)->update(['route_name' => null, 'stop_name' => null]);
                Bus::where('route_name', $route_name)->delete();
                $stop = Stop::where('route_name', $route_name);
                $stop->delete();
                $route->delete();
            }
            return redirect('/showroute');
        } else {
            return redirect('/error');
        }
    }
}

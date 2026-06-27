<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Stop;

class BusDetailsController extends Controller
{
    public function busdetails(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $data = Student::where('email', $email)->first();


            return view('bus-details', compact('email', 'data'));
        } else {
            return redirect('/error');
        }
    }


    public function assignbus(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $datas = DB::table('route')->get();
            return view('assign-bus', compact('email', 'datas'));
        } else {
            return redirect('/error');
        }
    }
    public function assignbuss(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $route_name = $request->route_name;
            $stop_name = $request->stop_name;
            Student::where('email', $email)->update([
                'route_name' => $route_name,
                'stop_name' => $stop_name
            ]);
            $datas = DB::table('route')->get();
            $msg = "bus assign success";
            return view('assign-bus', compact('email', 'datas', 'msg'));
        } else {
            return redirect('/error');
        }
    }
    public function stop_fetch(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $routeName = $request->input('route_name');

            if (!$routeName) {
                return response()->json([]);
            }

            $stops = DB::table('stop')
                ->where('route_name', $routeName)
                ->get(['stop_name']);

            return response()->json($stops);
        } else {
            return redirect('/error');
        }
    }

    public function bus_fetch(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $route_name = $request->input('route_name');
            if (!$route_name) {
                return response()->json([]);
            }
            $stop = DB::table('bus')
                ->where('route_name', $route_name)
                ->first([
                    'bus_number',
                    'bus_name',
                    'driver_name',
                    'driver_phone',
                    'total_seats',
                    'available_seats'
                ]);
            return response()->json($stop);
        } else {
            return redirect('/error');
        }
    }
    public function t_fetch(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $st_name = $request->input('t');
            if (!$st_name) {
                return response()->json([]);
            }
            $stop = DB::table('stop')
                ->where('stop_name', $st_name)
                ->first([
                    'pickup_time',
                    'drop_time'
                ]);
            return response()->json($stop);
        } else {
            return redirect('/error');
        }
    }

    public function drop_bus(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $d_email = $request->email;
            Student::where('email', $d_email)->update(['stop_name' => null, 'route_name' => null]);
            $email = $request->email;
            $data = Student::where('email', $email)->first();
            return view('bus-details', compact('email', 'data'));
        } else {
            return redirect('/error');
        }
    }
}

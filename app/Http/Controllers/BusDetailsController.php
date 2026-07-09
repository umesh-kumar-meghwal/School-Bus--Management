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
            $school_email = $request->school_email;
            $data = Student::where('email', $email)->first();


            return view('bus-details', compact('email', 'data','school_email'));
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
            $school_email = $request->school_email;
            $datas = DB::table('route')->where('school_email',$school_email)->get();
            return view('assign-bus', compact('email', 'datas','school_email'));
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
            $school_email = $request->school_email;
            Student::where('school_email',$school_email)->where('email', $email)->update([
                'route_name' => $route_name,
                'stop_name' => $stop_name,
            ]);
            $datas = DB::table('route')->get();
            $msg = "bus assign success";
            return view('assign-bus', compact('email', 'datas', 'msg','school_email'));
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
            $school_email = $request->input('school_email');

            if (!$routeName) {
                return response()->json([]);
            }

            $stops = DB::table('stop')
                ->where('school_email',$school_email)
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
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school' || $usertype == "student") {
            $route_name = $request->input('route_name');
            $school_email = $request->input('school_email');
            if (!$route_name) {
                return response()->json([]);
            }
            $stop = DB::table('bus')
                ->where('school_email',$school_email)
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
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school' || $usertype == "student") {
            $st_name = $request->input('t');
            $school_email = $request->input('school_email');
            if (!$st_name) {
                return response()->json([]);
            }
            $stop = DB::table('stop')->where('school_email',$school_email)
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
            $school_email = $request->school_email;
            Student::where('school_email',$school_email)->where('email', $d_email)->update(['stop_name' => null, 'route_name' => null]);
            $email = $request->email;
            $data = Student::where('school_email',$school_email)->where('email', $email)->first();
            return view('bus-details', compact('email', 'data'));
        } else {
            return redirect('/error');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Stop;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ShowStopsController extends Controller
{
    public function add(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('route')->where('school_email',Crypt::decryptString($school_email))->get();
            return view('add-stop', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function save(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('route')->where('id', $request->route_id)->first();
            Stop::create([
                'stop_name' => $request->stop_name,
                'route_id' => $request->route_id,
                'route_name' => $data->route_name,
                'pickup_time' => $request->pick_time,
                'drop_time' => $request->drop_time,
                'latitude' => $request->lat,
                'longitude' => $request->long,
                'school_email' => Crypt::decryptString($request->school_email)
            ]);
            $school_email = $request->school_email;
            $data = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-stop', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-stop', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->school_email;
            $data = DB::table('stop')->where('id', $request->id)->first();
            $data1 = DB::table('route')->where('school_email',Crypt::decryptString($school_email))->get();
            return view('edit-stop', compact('data', 'data1'));
        } else {
            return redirect('/error');
        }
    }
    public function edits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            Stop::where('id', $request->id)->update([
                'route_name' => $request->route_name,
                'route_id' => $request->route_id,
                'stop_name' => $request->stop_name,
                'pickup_time' => $request->pickup_time,
                'drop_time' => $request->drop_time,
                'latitude' => $request->lat,
                'longitude' => $request->long

            ]);
            $school_email = $request->school_email;
            $data = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-stop', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $stop = Stop::where('id', $request->id)->first();
            $school_email = $request->school_email;
            if ($stop) {
                $stop_name = $stop->stop_name;
                Student::where('school_email',Crypt::decryptString($school_email))->where('stop_name', $stop_name)->update(['stop_name' => null]);
                Student::where('school_email',Crypt::decryptString($school_email))->where('stop_name', $stop_name)->update(['route_name' => null]);
                $stop->delete();
            }
            else{
                return redirect('/error');
            }
            $data = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-stop', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function oneShow(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('stop')->where('route_id', $request->route_id)->get();
            return view('stop-one-show', compact('data'));
        } else {
            return redirect('/error');
        }
    }

    public function id_fetch(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $r_name  = $request->input('r_name');
            $school_email = $request->input('school_email');
            $r_id = DB::table('route')->where('school_email',Crypt::decryptString($school_email))->where('route_name',$r_name)->first();
            return response()->json($r_id);
        } else {
            return redirect('/error');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Stop;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class ShowStopsController extends Controller
{
    public function add()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $data = DB::table('route')->get();
            return view('add-stop', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function save(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $data = DB::table('route')->where('id', $request->route_id)->first();
            Stop::create([
                'stop_name' => $request->stop_name,
                'route_id' => $request->route_id,
                'route_name' => $data->route_name,
                'pickup_time' => $request->pick_time,
                'drop_time' => $request->drop_time,
                'latitude' => $request->lat,
                'longitude' => $request->long
            ]);
            return redirect('/show-stops');
        } else {
            return redirect('/error');
        }
    }
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $data = DB::table('stop')->get();
            return view('show-stop', compact('data'));
        } else {
            return redirect('/error');
        }
    }

    public function edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype'); 
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $data = DB::table('stop')->where('id', $request->id)->first();
            $data1 = DB::table('route')->get();
            return view('edit-stop', compact('data', 'data1'));
        } else {
            return redirect('/error');
        }
    }
    public function edits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            Stop::where('id', $request->id)->update([
                'route_name' => $request->route_name,
                'route_id'=>$request->route_id,
                'stop_name' => $request->stop_name,
                'pickup_time' => $request->pickup_time,
                'drop_time' => $request->drop_time,
                'latitude' => $request->lat,
                'longitude' => $request->long

            ]);
            return redirect('/show-stops');
        } else {
            return redirect('/error');
        }
    }

    public function delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $stop = Stop::where('id', $request->id)->first();
            if ($stop) {
                $stop_name = $stop->stop_name;
                Student::where('stop_name', $stop_name)->update(['stop_name' => null]);
                Student::where('stop_name', $stop_name)->update(['route_name' => null]);
                $stop->delete();
            }
            return redirect('/show-stops');
        } else {
            return redirect('/error');
        }
    }

    public function oneShow(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
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
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $r_id = DB::table('route')->where('route_name',$request->r_name)->first();
            return response()->json($r_id);
        } else {
            return redirect('/error');
        }
    }
}

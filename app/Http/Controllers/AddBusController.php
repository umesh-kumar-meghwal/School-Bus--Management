<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddBusController extends Controller
{
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('route')->get();
            $ddata = DB::table('driver')->get();
            return view('addbus', compact('data', 'ddata'));
        } else {
            return redirect('/error');
        }
    }
    public function store(Request $request)

    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $bus_num = $request->bus_number;
            $bus_num_check = DB::table('bus')->where('bus_number', $bus_num)->first();
            $route_name_check = DB::table('bus')->where('route_name', $request->route_name)->first();
            if (isset($bus_num_check->bus_number) != $request->bus_number && isset($route_name_check->route_name) != $request->route_name) {

                Bus::create([
                    'bus_number' => $request->bus_number,
                    'bus_name' => $request->bus_name,
                    'driver_name' => $request->driver_name,
                    'driver_phone' => $request->driver_phone,
                    'route_name' => $request->route_name,
                    'total_seats' => $request->total_seats,
                    'available_seats' => $request->available_seats,
                    'status' => $request->status,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ]);


                $data = DB::table('route')->get();
                $ddata = DB::table('driver')->get();
                $msg = "Bus Register Successfully";
            } else {
                $data = DB::table('route')->get();
                $ddata = DB::table('driver')->get();

                $msg = "Bus Already Registered";
            }

            return view('addbus', compact('msg', 'data', 'ddata'));
        } else {
            return redirect('/error');
        }
    }

    public function fetch_phone(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $name = $request->input('name');
            if ($name != "select") {
                $data = DB::table('driver')->where('name', $name)->first();
                $phone = $data->phone;
                return response()->json([
                    'reply' => $phone
                ]);
            } else {
                $phone =  '';
                return response()->json([
                    'reply' => $phone
                ]);
            }
        } else {
            return redirect('/error');
        }
    }
}

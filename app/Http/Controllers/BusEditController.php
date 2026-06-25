<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bus;

class BusEditController extends Controller
{
    public function edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $id = $request->id;
            $data = DB::table('bus')->where('id', $id)->first();
            $datas = DB::table('route')->get();
            $ddatas = DB::table('driver')->get();
            return view('busedit', compact('data', 'datas', 'ddatas'));
        } else {
            return redirect('/error');
        }
    }
    public function save(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $id = $request->id;
            $bus_number = $request->bus_number;
            $bus_name = $request->bus_name;
            $driver_name = $request->driver_name;
            $driver_phone = $request->driver_phone;
            $route_name = $request->route_name;
            $total_seats = $request->total_seats;
            $available_seats = $request->available_seats;
            $status = $request->status;
            Bus::where('id', $id)->update([
                'bus_number' => $bus_number,
                'bus_name' => $bus_name,
                'driver_name' => $driver_name,
                'driver_phone' => $driver_phone,
                'route_name' => $route_name,
                'total_seats' => $total_seats,
                'available_seats' => $available_seats,
                'status' => $status
            ]);
            return redirect('/busshow');
        } else {
            return redirect('/error');
        }
    }
    public function delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $id = $request->id;
            Bus::where('id', $id)->delete();
            return redirect('/busshow');
        } else {
            return redirect('/error');
        }
    }
}

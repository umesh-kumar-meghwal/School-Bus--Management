<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Bus;

class DriverShowController extends Controller
{
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('driver')->where('school_email',Crypt::decryptString($school_email))->get();
            return view('drivershow', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function editshow(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $id = $request->id;
            $data = DB::table('driver')->where('id', $id)->first();
            return view('driveredit', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function change(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $id = $request->id;
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $license = $request->license;
            Driver::where('id', $id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'license_number' => $license
            ]);
            $school_email = $request->school_email;
            $data = DB::table('driver')->where('school_email',Crypt::decryptString($school_email))->get();
            return view('drivershow', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function delete(Request $request)

    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $id = $request->id;
            $driver = Driver::where('id', $id)->first();
            if ($driver) {
                $driver_name = $driver->name;
                Bus::where('driver_name', $driver_name)->update(['driver_name' => 'No Name', 'driver_phone' => 'No Phone']);
                $driver->delete();
            }
            $school_email = $request->school_email;
            $data = DB::table('driver')->where('school_email',Crypt::decryptString($school_email))->get();
            return view('drivershow', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }
}

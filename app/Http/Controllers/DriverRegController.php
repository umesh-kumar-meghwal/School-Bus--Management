<?php

namespace App\Http\Controllers;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Driver;
use App\Models\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class DriverRegController extends Controller
{
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            return view('driverreg',compact('school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function store(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $lic = $request->license;
            $lic_num = DB::table('driver')->where('license_number', $lic)->first();
            $d_email = DB::table('driver')->where('email', $request->email)->first();
            if (isset($lic_num->license_number) != $lic && isset($d_email->email) != $request->email) {
                Driver::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'license_number' => $request->license,
                    'school_email'=>Crypt::decryptString($request->school_email)
                ]);
                $u = 'driver';
                Login::create([
                    'email' => $request->email,
                    'password' => $request->password,
                    'usertype' => $u
                ]);
                $msg = "Driver Register Successfully";
            } else {
                $msg = "Driver Already Register";
            }
            $school_email = $request->school_email;
            return view('driverreg', compact('msg','school_email'));
        } else {
            return redirect('/error');
        }
    }
}

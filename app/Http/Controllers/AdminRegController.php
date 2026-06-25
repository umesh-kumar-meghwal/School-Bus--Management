<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Admin;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class AdminRegController extends Controller
{

    public function adminreg()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            return view('adminreg');
        }else {
            return redirect('/error');
        }
    }

    public function store(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $f = DB::table('login')->where('email', $request->email)->first();
            if ($f) {
                $msg = "Admin Registered Already !";
            }else{
                Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact' => $request->contact,
                    'address' => $request->address
                ]);
                $usertype = 'admin';
                Login::create([
                    'email' => $request->email,
                    'password' => $request->password,
                    'usertype' => $usertype
                ]);
                $msg = "Admin Register Successfully";
            }
            return view('adminreg', compact('msg'));
        } else {
            return redirect('/error');
        }
    }
}

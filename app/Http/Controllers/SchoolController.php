<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function school_reg()
    {
        return view('school-reg');
    }
    public function school_regs(Request $request)
    {
        $data = DB::table('school')->where('school_email', $request->input('school_email'))->first();
        if ($data) {
            $msg = ['message' => 'School Already Registered!', 'status' => 'success'];
        } else {
            School::create([
                'school_name' => $request->input('school_name'),
                'school_email' => $request->input('school_email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address')
            ]);
            Login::create([
                'email' => $request->input('school_email'),
                'password' => $request->input('password'),
                'usertype' => 'school'
            ]);
            $msg = ['message' => 'School Registration Success!', 'status' => 'success'];
        }
        return response()->json($msg);
    }


    public function school_dashboard()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'school') {
            return view('school-dashboard');
        } else {
            return redirect('/error');
        }
    }
}

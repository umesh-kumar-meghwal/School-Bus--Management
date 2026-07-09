<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SdashboardController extends Controller
{
    public function sdashboard()
    {
        $email = session('user');
        $usertype = session('usertype');
        $school_email = session('school_email');
        if (!empty(session('user')) && $usertype == "student") {
            $data = DB::table('student')->where('school_email',$school_email)->where('email', $email)->first();
            $school_name = DB::table('school')->where('school_email',$school_email)->first()->school_name;
            return view('s-dashboard', compact('data', 'email','school_name','school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function sfee_details()
    {
        $email = session('user');
        $usertype = session('usertype');
        $school_email = session('school_email');
        if (!empty(session('user')) && $usertype == "student") {
            $email = session('user');
            $data = DB::table('student_fee')->where('school_email',$school_email)->where('st_email', $email)->get();
            return view('s-fee-details', compact('data'));
        } else {
            return redirect('/error');
        }
    }
}

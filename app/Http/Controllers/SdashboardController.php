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
        if (!empty(session('user')) && $usertype == "student") {
            $data = DB::table('student')->where('email', $email)->first();
            return view('s-dashboard', compact('data','email'));
        } else {
            return redirect('/error');
        }
    }

    public function sfee_details()
    {
        $email = session('user');
        $data = DB::table('student_fee')->where('st_email',$email)->get();
        return view('s-fee-details',compact('data'));
    }
}

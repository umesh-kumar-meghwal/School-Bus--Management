<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StudentShowController extends Controller
{



    public function shows(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('student')->where('school_email',Crypt::decryptString($request->q))->get();
            return view('studentshow', [
                'school_email' => $school_email,
                'data' => $data
            ]);
        } else {
            return redirect('/error');
        }
    }



    public function sprofileshow(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $data = DB::table('student')->where('email', $email)->first();
            return view('s-profileshow', compact('data'));
        } else {
            return redirect('/error');
        }
    }
}

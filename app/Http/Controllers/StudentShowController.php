<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentShowController extends Controller
{
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $data = DB::table('student')->orderBy('name','asc')->get();
            return view('studentshow', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function sprofileshow(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $email = $request->email;
            $data = DB::table('student')->where('email', $email)->first();
            return view('s-profileshow', compact('data'));
        } else {
            return redirect('/error');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class BusShowController extends Controller
{
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            try {
                $school_email = $request->q;
            } catch (\Exception $e) {
                return redirect('/error');
            }
            $data = DB::table('bus')->where('school_email', Crypt::decryptString($request->q))->get();
            return view('busshow', compact('data','school_email'));
        } else {
            return redirect('/error');
        }
    }
}

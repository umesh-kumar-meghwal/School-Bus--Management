<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BusShowController extends Controller
{
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $data = DB::table('bus')->get();
            return view('busshow', compact('data'));
        } else {
            return redirect('/error');
        }
    }
}

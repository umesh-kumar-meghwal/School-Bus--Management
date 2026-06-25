<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class AdminShowController extends Controller
{
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $data = DB::table('admin')->get();
            return view('adminshow', compact('data'));
        } else {
            return redirect('/error');
        }
    }
}

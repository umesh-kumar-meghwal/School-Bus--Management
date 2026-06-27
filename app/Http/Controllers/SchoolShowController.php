<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolShowController extends Model
{
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $data = DB::table('school')->get();
            return view('show-school', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function school_delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            School::where('school_email',$request->school_email)->delete();
            $data = DB::table('school')->get();
            return view('show-school',compact('data'));
        } else {
            return redirect('/error');
        }
    }
}

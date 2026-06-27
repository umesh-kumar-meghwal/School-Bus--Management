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
            School::where('school_email', $request->email)->delete();
            $data = DB::table('school')->get();
            return view('show-school', compact('data'));
        } else {
            return redirect('/error');
        }
    }

    public function school_edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $data = DB::table('school')->where('school_email', $request->email)->first();
            return view('school-edit', compact('data'));
        } else {

            return redirect('/error');
        }
    }

    public function school_edits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            School::where('school_email', $request->input('school_email'))->update([
                'school_name' => $request->input('school_name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address')
            ]);
            $data = ['message' => 'Save success'];
            return response()->json($data);
        } else {
            return redirect('/error');
        }
    }
}

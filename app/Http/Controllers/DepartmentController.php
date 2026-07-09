<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Models\Student;

class DepartmentController extends Controller
{
    public function add_depart(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            return view('add-department', compact('school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function store(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $depart_name = $request->depart_name;
            $school_email = $request->school_email;
            Department::create([
                'depart_name' => $depart_name,
                'school_email' => Crypt::decryptString($school_email)
            ]);
            $msg = "Department Add Successfully";
            return view('add-department', compact('msg', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('department')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-department', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = department::where('id', $request->id)->first();
            return view('department-edit', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function edits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->school_email;
            department::where('id', $request->id)->update([
                'depart_name' => $request->depart_name
            ]);
            $data = DB::table('department')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-department', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $depart = department::where('id', $request->id)->first();
            $school_email = $request->school_email;
            student::where('school_email', Crypt::decryptString($school_email))->where('depart_name', $depart->depart_name)->update(['depart_name' => null]);
            $depart->delete();
            $data = DB::table('department')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-department', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
}

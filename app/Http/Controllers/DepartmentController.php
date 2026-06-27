<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class DepartmentController extends Controller
{
    public function add_depart()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            return view('add-department');
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
            Department::create([
                'depart_name' => $depart_name
            ]);
            $msg = "Department Add Successfully";
            return view('add-department', compact('msg'));
        } else {
            return redirect('/error');
        }
    }
    public function show()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('department')->get();
            return view('show-department', compact('data'));
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
            department::where('id', $request->id)->update([
                'depart_name' => $request->depart_name
            ]);
            return redirect('/show-depart');
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
            student::where('depart_name', $depart->depart_name)->update(['depart_name' => null]);
            $depart->delete();
            return redirect('/show-depart');
        } else {
            return redirect('/error');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function student()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $data = DB::table('department')->get();
            return view('student', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function store(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $f = DB::table('login')->where('email', $request->email)->first();
            $data = DB::table('department')->get();

            if ($f) {
                $msg = "Student Registered Already !";
            } else {
                Student::create([
                    'name' => $request->name,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'mobile' => $request->mobile,
                    'guardians_mobile' => $request->guardians_mobile,
                    'depart_name' => $request->depart_name,
                    'email' => $request->email,
                    'address' => $request->address
                ]);
                $usertype = 'student';
                Login::create([
                    'email' => $request->email,
                    'password' => $request->password,
                    'usertype' => $usertype
                ]);
                $msg = "Student Register Successfully";
            }
            return view('student', compact('msg', 'data'));
        } else {
            return redirect('/error');
        }
    }
}

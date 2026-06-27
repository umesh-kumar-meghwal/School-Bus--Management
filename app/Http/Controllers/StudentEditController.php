<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentEditController extends Controller
{
    public function shows()
    {
        return redirect('/error');
    }
    public function show(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $email = $request->email;

            $data = DB::table('student')->where('email', $email)->first();
            $datas = DB::table('department')->get();
            return view('studentedit', compact('data','datas'));
        } else {
            return redirect('/error');
        }
    }

    public function changes()
    {
        return redirect('/error');
    }
    public function change(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
            $name = $request->name;
            $father_name = $request->father_name;
            $mother_name = $request->mother_name;
            $mobile = $request->mobile;
            $guardians_mobile = $request->guardians_mobile;
            $depart_name = $request->depart_name;
            $email = $request->email;
            $address = $request->address;
            echo $email;
            Student::where('email', $email)->update([
                'name' => $name,
                'father_name' =>$father_name,
                'mother_name' => $mother_name,
                'mobile' => $mobile,
                'guardians_mobile' =>$guardians_mobile,
                'depart_name'=>$depart_name,
                'address' => $address
            ]);
            return redirect('studentshow');
        } else {
            return redirect('/error');
        }
    }
}

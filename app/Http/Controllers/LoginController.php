<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = DB::table('login')->where('email', $email)->first();
        $data1 = DB::table('driver')->where('email',$email)->first();
        $data2 = DB::table('student')->where('email',$email)->first();

        if ($data) {
            if ($data->password ==$password) {

            if($data->usertype=='student'){
                session(['user' => $data->email]);
                session(['usertype' => $data->usertype]);
                session(['school_email'=>$data2->school_email]);

                return redirect('s-dashboard');
                
            }else if($data->usertype=='driver') {
                session(['user'=>$data->email]);
                session(['usertype'=>$data->usertype]);
                session(['school_email'=>$data1->school_email]);

                return redirect('d-dashboard');

            }else if($data->usertype=='school'){
                session(['user'=>$data->email]);
                session(['usertype'=>$data->usertype]);
                session(['school_email'=>$data->email]);
                return redirect('school-dashboard');
            }else{
                session(['user' => $data->email]);
                session(['usertype' => $data->usertype]);
                return redirect('a-dashboard');
            }

            } else {
                return redirect()->back()->with('error', 'error');
            }
        } else {
            return redirect()->back()->with('error', 'error-email');
        }
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class DDashboardController extends Controller
{
    public function ddashboard()
    {
        $email = session('user');
        $usertype = session('usertype');
        $school_email = session('school_email');
        if(!empty($email) && $usertype == 'driver'){
            $data = DB::table('driver')->where('school_email',$school_email)->where('email',$email)->first();
            $school_name = DB::table('school')->where('school_email',$school_email)->first()->school_name;
            return view('d-dashboard',compact('data','school_name'));
        }else{
            return redirect('/error');
        }
    }
    public function fetch_b(Request $request){
        $school_email = session('school_email');
        $phone = $request->input('phone');
        if(!$phone){
            return response()->json([]);
        }
        $data = DB::table('bus')->where('school_email',$school_email)
        ->where('driver_phone',$phone)
        ->first([
        'bus_number',
        'bus_name',
        'route_name',
        'total_seats',
        'available_seats',
        'status'
        ]);
        return response()->json($data);
        
    }
    public function fetch_s(Request $request)
    {
        $school_email = session('school_email');

        $route_name = $request->input('route_name');
        $data = DB::table('student')->where('school_email',$school_email)->where('route_name',$route_name)->get();
        return response()->json($data);

    }
}
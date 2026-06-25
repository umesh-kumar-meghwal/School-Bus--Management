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
        if(!empty($email) && $usertype == 'driver'){
            $data = DB::table('driver')->where('email',$email)->first();
            return view('d-dashboard',compact('data'));
        }else{
            return redirect('/error');
        }
    }
    public function fetch_b(Request $request){

        $phone = $request->input('phone');
        if(!$phone){
            return response()->json([]);
        }
        $data = DB::table('bus')
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
        $route_name = $request->input('route_name');
        $data = DB::table('student')->where('route_name',$route_name)->get();
        return response()->json($data);

    }
}
<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Ip;

class IpFetchController extends Controller
{
    public function ip_fetch(Request $request)
    {
        $ip = $request->ip();
        Ip::create([
            'ip'=>$ip
        ]);
        $msg ="sucess";
        return response()->json($msg);
    }
}

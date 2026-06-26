<?php


namespace App\Http\Controllers;

use Illuminate\Http\Client\Request;

class IpFetchController extends Controller
{
    public function ip_fetch(Request $request)
    {
        return response()->json([
            'ip' => $request->ip()
        ]);
    }
}

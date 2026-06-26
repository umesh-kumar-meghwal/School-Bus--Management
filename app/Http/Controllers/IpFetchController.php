<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IpFetchController extends Controller
{
    public function ip_fetch(Request $request)
    {
        $ip = $request->ip();

        $response = Http::get("https://ipwho.is/$ip");

        $data = $response->json();

        return response()->json([
            'ip'        => $ip,
            'city'      => $data['city'] ?? '',
            'state'     => $data['region'] ?? '',
            'country'   => $data['country'] ?? '',
            'latitude'  => $data['latitude'] ?? '',
            'longitude' => $data['longitude'] ?? '',
        ]);
    }
}

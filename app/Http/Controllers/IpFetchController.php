<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IpFetchController extends Controller
{
    public function ip_fetch(Request $request)
    {
        $ip = $request->ip();

        $response = Http::get("https://ipapi.co/{$ip}/json/");

        return response()->json([
            'ip' => $ip,
            'city' => $response['city'] ?? null,
            'state' => $response['region'] ?? null,
            'country' => $response['country_name'] ?? null,
            'latitude' => $response['latitude'] ?? null,
            'longitude' => $response['longitude'] ?? null,
        ]);
    }
}

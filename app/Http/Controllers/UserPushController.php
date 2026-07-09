<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use App\Models\Notification;
use App\Models\Student_Fee;
use Illuminate\Support\Facades\Crypt;

class UserPushController extends Controller
{
    public function push(Request $request)
    {
        $school_email = $request->q;
        return view('push', compact('school_email'));
    }

    public function user_push($emails, $title, $body)
    {
        $appId = env('ONESIGNAL_APP_ID');
        $restKey = env('ONESIGNAL_REST_API_KEY');
        $cleanEmails = array_map(function ($email) {
            return strtolower(trim($email));
        }, $emails);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $restKey,
            'Content-Type' => 'application/json',
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id' => $appId,
            'include_external_user_ids' => $cleanEmails,
            'headings' => [
                'en' => $title,
            ],
            'contents' => [
                'en' => $body,
            ],
            'android_sound' => 'bus_horn',
        ]);

        return $response->json();
    }
    public function pushed(Request $request)
    {
        $school_email = $request->input('school_email');
        $title = $request->input('title');
        $body = $request->input('content');
        $emails = DB::table('student')
            ->where('school_email', Crypt::decryptString($school_email))
            ->pluck('email')
            ->toArray();
        $this->user_push($emails, $title, $body);
        $decryptedSchoolEmail = Crypt::decryptString($school_email);
        $notifications = [];
        foreach ($emails as $email) {
            $notifications[] = [
                'title' => $title,
                'content' => $body,
                'school_email' => $decryptedSchoolEmail,
                'user_email' => $email,
            ];
        }

        Notification::insert($notifications);
        $msg = "success";

        return response()->$msg;
    }
}

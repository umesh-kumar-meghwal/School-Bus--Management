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
        $time = $request->input('time');
        $date = $request->input('date');
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
                'time' => $time,
                'date' => $date,
                'checks' => 0
            ];
        }
        Notification::insert($notifications);
        $msg = ["msg" => "success"];
        return response()->json($msg);
    }

    public function s_push(Request $request)
    {
        $school_email = $request->shq;
        $st_email = $request->sq;
        $data = DB::table('notification')->where('school_email', Crypt::decryptString($school_email))->where('user_email', $st_email)->orderBy('id', 'desc')->get();
        return view('s-push', compact('school_email', 'st_email', 'data'));
    }


    public function s_pushed(Request $request)
    {
        $school_email = $request->input('school_email');
        $title = $request->input('title');
        $body = $request->input('content');
        $st_email = $request->input('st_email');
        $date = $request->input('date');
        $time = $request->input('time');
        $decryptedSchoolEmail = Crypt::decryptString($school_email);
        $student_name = DB::table('student')->where('school_email', $decryptedSchoolEmail)->where('email', $st_email)->first()->name;
        $body = "Dear " . $student_name . " ❤ ," . $body;

        $rawUrl = "/notification?sq=" . $st_email . "&shq=" . $school_email;
        $url = str_replace('http://', 'https://', $rawUrl);


        $this->student_push($st_email, $title, $body, $url);
        Notification::create([
            'title' => $title,
            'content' => $body,
            'school_email' => $decryptedSchoolEmail,
            'user_email' => $st_email,
            'time' => $time,
            'date' => $date,
            'checks' => 0
        ]);
        $msg = ["msg" => "success"];
        return response()->json($msg);
    }

    public function hh()
    {
        DB::table('notification')->delete();
    }

    public function student_push($st_email, $title, $body, $targetUrl=null)
    {
        $appId = env('ONESIGNAL_APP_ID');
        $restKey = env('ONESIGNAL_REST_API_KEY');
        $payload = [
            'app_id' => $appId,
            'include_external_user_ids' => [$st_email],
            'headings' => ['en' => $title],
            'contents' => ['en' => $body],
            'android_sound' => 'bus_horn',
        ];

       if ($targetUrl) {
        $payload['data'] = [
            'targetUrl' => $targetUrl
        ];
    }

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $restKey,
            'Content-Type' => 'application/json',
        ])->post('https://onesignal.com/api/v1/notifications', $payload);

        return $response->json();
    }

    public function notification(Request $request)
    {
        $school_email = Crypt::decryptString($request->shq);
        $st_email = $request->sq;
        $data = DB::table('notification')->where('school_email', $school_email)->where('user_email', $st_email)->orderBy('id', 'desc')->get();
        Notification::where('school_email', $school_email)->where('user_email', $st_email)->update([
            'checks' => 1
        ]);
        return view('notification', compact('data'));
    }
    public function noti_count(Request $request)
    {
        $school_email = $request->input('school_email');
        $st_email = $request->input('st_email');
        $data = DB::table('notification')->where('school_email', $school_email)->where('user_email', $st_email)->pluck('checks')->toArray();
        $zero_count = 0;
        $one_count = 0;
        foreach ($data as $d) {
            if ($d == 0) {
                $zero_count += 1;
            } else {
                $one_count += 1;
            }
        }
        if ($zero_count == 0) {
            $zero_count = " ";
        }
        $d_count = ["noti_count" => $zero_count];
        return response()->json($d_count);
    }
}

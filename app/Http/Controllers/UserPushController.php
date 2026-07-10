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
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            return view('push', compact('school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function user_push($emails, $title, $body)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
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
        } else {
            return redirect('/error');
        }
    }
    public function pushed(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
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
        } else {
            return redirect('/error');
        }
    }

    public function delete_push(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $id = $request->id;
            $school_email = $request->school_email;
            $st_email = $request->user_email;
            $data = DB::table('notification')->where('school_email', $school_email)->where('user_email', $st_email)->orderBy('id', 'desc')->get();
            DB::table('notification')->where('id', $id)->delete();
            return view('s-push', compact('school_email', 'st_email', 'data'));
        } else {
            return redirect('/error');
        }
    }

    public function s_push(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->shq;
            $st_email = $request->sq;
            $data = DB::table('notification')->where('school_email', Crypt::decryptString($school_email))->where('user_email', $st_email)->orderBy('id', 'desc')->get();
            return view('s-push', compact('school_email', 'st_email', 'data'));
        } else {
            return redirect('/error');
        }
    }


    public function s_pushed(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->input('school_email');
            $title = $request->input('title');
            $body = $request->input('content');
            $st_email = $request->input('st_email');
            $date = $request->input('date');
            $time = $request->input('time');
            $decryptedSchoolEmail = Crypt::decryptString($school_email);
            $student_name = DB::table('student')->where('school_email', $decryptedSchoolEmail)->where('email', $st_email)->first()->name;
            $body = "Dear " . $student_name . " ❤ ," . $body;



            $this->student_push($st_email, $title, $body);
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
        } else {
            return redirect('/error');
        }
    }

    public function hh()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            DB::table('notification')->delete();
        } else {
            return redirect('/error');
        }
    }

    public function student_push($st_email, $title, $body)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $appId = env('ONESIGNAL_APP_ID');
            $restKey = env('ONESIGNAL_REST_API_KEY');
            $payload = [
                'app_id' => $appId,
                'include_external_user_ids' => [$st_email],
                'headings' => ['en' => $title],
                'contents' => ['en' => $body],
                'android_sound' => 'bus_horn',
            ];


            $payload['data'] = [
                'q' => "umesh"
            ];


            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $restKey,
                'Content-Type' => 'application/json',
            ])->post('https://onesignal.com/api/v1/notifications', $payload);

            return $response->json();
        } else {
            return redirect('/error');
        }
    }

    public function notification(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'student') {
            $school_email = Crypt::decryptString($request->shq);
            $st_email = $request->sq;
            $data = DB::table('notification')->where('school_email', $school_email)->where('user_email', $st_email)->orderBy('id', 'desc')->get();
            Notification::where('school_email', $school_email)->where('user_email', $st_email)->update([
                'checks' => 1
            ]);
            return view('notification', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function noti_count(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'student') {
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
        } else {
            return redirect('/error');
        }
    }
}

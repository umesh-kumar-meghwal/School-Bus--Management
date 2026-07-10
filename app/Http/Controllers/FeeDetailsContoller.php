<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Fee;
use App\Models\Notification;
use App\Models\Student_Fee;
use Illuminate\Support\Facades\Crypt;

class FeeDetailsContoller extends Controller
{


    public function sendPush($targetEmail, $title, $body)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {

            $appId = env('ONESIGNAL_APP_ID');
            $restKey = env('ONESIGNAL_REST_API_KEY');
            $cleanEmail = strtolower(trim($targetEmail));

            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $restKey,
                'Content-Type' => 'application/json',
            ])->post('https://onesignal.com/api/v1/notifications', [
                'app_id' => $appId,
                'include_external_user_ids' => [$cleanEmail], // Updated Clean Email
                'headings' => ['en' => $title],
                'contents' => ['en' => $body],
                'android_sound' => 'bus_horn',
            ]);

            return $response->json();
        } else {
            return redirect('/error');
        }
    }
    public function add_fee(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('add-fee', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function add_fees(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->school_email;
            $stop_name = $request->stop_name;
            $fee = $request->fee;
            $data = DB::table('feest')->where('school_email', Crypt::decryptString($school_email))->where('stop_name', $stop_name)->first();
            if (!$data) {
                Fee::create([
                    'stop_name' => $stop_name,
                    'fee' => $fee,
                    'school_email' => Crypt::decryptString($school_email)
                ]);
                $data = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
                $msg = 'fee added success';
                return view('add-fee', compact('data', 'msg', 'school_email'));
            } else {
                $msg = "fee added already";
                $data = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
                return view('add-fee', compact('data', 'msg', 'school_email'));
            }
        } else {
            return redirect('/error');
        }
    }

    public function show_fee(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->q;
            $data = DB::table('feest')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-fee', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function fee_edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->school_email;
            $data = DB::table('feest')->where('id', $request->id)->first();
            $data1 = DB::table('stop')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('fee-edit', compact('data', 'data1'));
        } else {
            return redirect('/error');
        }
    }
    public function fee_edits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            Fee::where('id', $request->id)->update([
                'stop_name' => $request->stop_name,
                'fee' => $request->fee
            ]);
            $school_email = $request->school_email;
            $data = DB::table('feest')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-fee', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function fee_delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('feest')->where('id', $request->id)->delete();
            $school_email = $request->school_email;
            $data = DB::table('feest')->where('school_email', Crypt::decryptString($school_email))->get();
            return view('show-fee', compact('data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }


    public function fee_details(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $school_email = $request->school_email;
            $data = DB::table('student_fee')->where('school_email', $school_email)->where('st_email', $email)->get();
            return view('fee-details', compact('email', 'data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function deposits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $school_email = $request->school_email;
            $data = DB::table('feest')->where('school_email', $school_email)->get();
            return view('deposit-fee', compact('email', 'data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function deposit_fee(Request $request)
    {

        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $stop_name = $request->stop_name;
            $total_fee = $request->total_fee;
            $deposit_fee = $request->deposit_fee;
            $date = $request->date;
            $time = $request->time;
            $school_email = $request->school_email;
            $last_fee = DB::table('student_fee')->where('school_email', $school_email)->where('st_email', $email)->where('stop_name', $stop_name)->orderBy('id', 'desc')->first();
            $stop_check = DB::table('student_fee')->where('school_email', $school_email)->where('st_email', $email)->first();
            $student_name = DB::table('student')->where('school_email', $school_email)->where('email', $email)->first()->name;
            if (isset($last_fee) && isset($stop_check->stop_name) == $request->stop_name) {
                $new_due = $last_fee->due_fee - $deposit_fee;
                Student_Fee::create([
                    'st_email' => $email,
                    'stop_name' => $stop_name,
                    'total_fee' => $total_fee,
                    'deposit_fee' => $deposit_fee,
                    'due_fee' => $new_due,
                    'date' => $date,
                    'time' => $time,
                    'school_email' => $school_email
                ]);
                $msg = " Fee Deposit Success";
                $studentEmail = $request->email;
                $amount = $request->deposit_fee;
                Notification::create([
                    'title' => "Fee Deposited! 💳",
                    'content' => "Dear " . $student_name . ", Rs. " . $amount . " has been successfully credited.",
                    'school_email' => $school_email,
                    'user_email' => $studentEmail,
                    'time' => $time,
                    'date' => $date,
                    'checks' => 0
                ]);
                $this->sendPush(
                    $studentEmail,
                    "Fee Deposited! 💳",
                    "Dear " . $student_name . ", Rs. " . $amount . " has been successfully credited."
                );

                $data = DB::table('feest')->get();
                return view('deposit-fee', compact('email', 'data', 'msg', 'school_email'));
            } else {
                Student_Fee::create([
                    'st_email' => $email,
                    'stop_name' => $stop_name,
                    'total_fee' => $total_fee,
                    'deposit_fee' => $deposit_fee,
                    'due_fee' => intval($total_fee) - $deposit_fee,
                    'date' => $date,
                    'time' => $time,
                    'school_email' => $school_email
                ]);
                $msg = " Fee Deposit Success";
                $studentEmail = $request->email;
                $amount = $request->deposit_fee;
                Notification::create([
                    'title' => "Fee Deposited! 💳",
                    'content' => "Dear " . $student_name . ", Rs. " . $amount . " has been successfully credited.",
                    'school_email' => $school_email,
                    'user_email' => $studentEmail,
                    'time' => $time,
                    'date' => $date,
                    'checks' => 0

                ]);
                $this->sendPush(
                    $studentEmail,
                    "Fee Deposited! 💳",
                    "Dear " . $student_name . ", Rs. " . $amount . " has been successfully credited."
                );

                $data = DB::table('feest')->get();
                return view('deposit-fee', compact('email', 'data', 'msg', 'school_email'));
            }
        } else {
            return redirect('/error');
        }
    }


    public function fees_edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $email = $request->email;
            $school_email = $request->school_email;
            $data = DB::table('student_fee')->where('school_email', $school_email)->where('id', $request->id)->first();
            $data1 = DB::table('feest')->where('school_email', $school_email)->get();
            return view('fees-edit', compact('data', 'data1', 'school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function fees_edits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->school_email;
            Student_Fee::where('id', $request->id)->update([
                'stop_name' => $request->stop_name,
                'total_fee' => $request->total_fee,
                'deposit_fee' => $request->deposit_fee,
                'due_fee' => $request->due_fee,
                'date' => $request->date,
                'time' => $request->time
            ]);
            $data = DB::table('student_fee')->where('school_email', $school_email)->where('id', $request->id)->first();
            $data1 = DB::table('feest')->where('school_email', $school_email)->get();
            $msg = "Save Success";
            return view('/fees-edit', compact('msg', 'data', 'data1', 'school_email'));
        } else {
            return redirect('/error');
        }
    }
    public function fees_delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $school_email = $request->school_email;
            DB::table('student_fee')->where('id', $request->id)->delete();
            $data = DB::table('student_fee')->where('school_email', $school_email)->where('st_email', $request->email)->get();
            $email = $request->email;
            return view('fee-details', compact('email', 'data', 'school_email'));
        } else {
            return redirect('/error');
        }
    }

    public function total_fee_fetch(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $st_name = $request->input('st_name');
            $school_email = $request->input('school_email');
            $data = DB::table('feest')->where('school_email', $school_email)->where('stop_name', $st_name)->first();
            return response()->json($data);
        } else {
            return redirect('/error');
        }
    }
}

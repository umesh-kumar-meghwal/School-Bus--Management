<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fee;
use App\Models\Student_Fee;

class FeeDetailsContoller extends Controller
{
    public function add_fee()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('stop')->get();
            return view('add-fee', compact('data'));
        } else {
            return redirect('/error');
        }
    }
    public function add_fees(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $stop_name = $request->stop_name;
            $fee = $request->fee;
            $data = DB::table('feest')->where('stop_name', $stop_name)->first();
            if (!$data) {
                Fee::create([
                    'stop_name' => $stop_name,
                    'fee' => $fee
                ]);
                $data = DB::table('stop')->get();
                $msg = 'fee added success';
                return view('add-fee', compact('data', 'msg'));
            } else {
                $msg = "fee added already";
                $data = DB::table('stop')->get();
                return view('add-fee', compact('data', 'msg'));
            }
        } else {
            return redirect('/error');
        }
    }

    public function show_fee()
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('feest')->get();
            return view('show-fee', compact('data'));
        } else {
            return redirect('/error');
        }
    }

    public function fee_edit(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            $data = DB::table('feest')->where('id', $request->id)->first();
            $data1 = DB::table('stop')->get();

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
            return redirect('/show-fee');
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
            return redirect('/show-fee');
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
            $data = DB::table('student_fee')->where('st_email', $email)->get();
            return view('fee-details', compact('email', 'data'));
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
            $data = DB::table('feest')->get();
            return view('deposit-fee', compact('email', 'data'));
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
            $last_fee = DB::table('student_fee')->where('st_email', $email)->where('stop_name',$stop_name)->orderBy('id', 'desc')->first();
            $stop_check = DB::table('student_fee')->where('st_email',$email)->first();
            if (isset($last_fee) && isset($stop_check->stop_name) == $request->stop_name) {
                $new_due = $last_fee->due_fee - $deposit_fee;
                Student_Fee::create([
                    'st_email' => $email,
                    'stop_name' => $stop_name,
                    'total_fee' => $total_fee,
                    'deposit_fee' => $deposit_fee,
                    'due_fee' => $new_due,
                    'date' => $date,
                    'time' => $time
                ]);
                $msg = " Fee Deposit Success";
                $data = DB::table('feest')->get();
                return view('deposit-fee', compact('email', 'data', 'msg'));

            } else {
                Student_Fee::create([
                    'st_email' => $email,
                    'stop_name' => $stop_name,
                    'total_fee' => $total_fee,
                    'deposit_fee' => $deposit_fee,
                    'due_fee' => intval($total_fee) - $deposit_fee,
                    'date' => $date,
                    'time' => $time
                ]);
                $msg = " Fee Deposit Success";
                $data = DB::table('feest')->get();
                return view('deposit-fee', compact('email', 'data', 'msg'));
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
            $data = DB::table('student_fee')->where('id', $request->id)->first();
            $data1 = DB::table('feest')->get();
            return view('fees-edit', compact('data', 'data1'));
        } else {
            return redirect('/error');
        }
    }

    public function fees_edits(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            Student_Fee::where('id', $request->id)->update([
                'stop_name' => $request->stop_name,
                'total_fee' => $request->total_fee,
                'deposit_fee' => $request->deposit_fee,
                'due_fee' => $request->due_fee,
                'date' => $request->date,
                'time' => $request->time
            ]);
            $data = DB::table('student_fee')->where('id', $request->id)->first();
            $data1 = DB::table('feest')->get();
            $msg = "Save Success";
            return view('/fees-edit', compact('msg', 'data', 'data1'));
        } else {
            return redirect('/error');
        }
    }
    public function fees_delete(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin' || $usertype == 'school') {
            DB::table('student_fee')->where('id', $request->id)->delete();
            $data = DB::table('student_fee')->where('st_email', $request->email)->get();
            $email = $request->email;
            return view('fee-details', compact('email', 'data'));
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
            $data = DB::table('feest')->where('stop_name', $st_name)->first();
            return response()->json($data);
        } else {
            return redirect('/error');
        }
    }
}

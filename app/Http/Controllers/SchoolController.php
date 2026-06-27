<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function school_reg()
    {
        return view('school-reg');
    }
    public function school_regs(Request $request)
    {
        $data = DB::table('school')->where('school_email', $request->input('school_email'))->first();
        if (!$data) {
            School::create([
                'school_name' => $request->input('school_name'),
                'school_email' => $request->input('school_email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address')
            ]);
            $msg = ['message' => 'School Registration Success!', 'status' => 'success'];
        } else {
            $msg = ['message' => 'School Already Registered!', 'status' => 'success'];
        }
        return response()->json($msg);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function school_reg()
    {
        return view('school-reg');
    }
    public function school_regs(Request $request)
    {
        School::create([
            'school_name'=>$request->input('school_name'),
            'school_email'=>$request->input('school_email'),
            'phone'=>$request->input('phone'),
            'address'=>$request->input('address')

        ]);
        $data = ['message' => 'Success!', 'status' => 'success'];
        return response()->json($data);
    }
    

    
}

<?php

namespace App\Http\Controllers;

use App\Models\school;
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
    

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $email = session('user');
        $usertype = session('usertype');
        return view('home',compact('usertype'));
    }
}

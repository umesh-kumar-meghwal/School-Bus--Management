<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $email = session('user');
        $usertype = session('usertype');

        if ($usertype == "admin") {
            return redirect("a-dashboard");
        } elseif ($usertype == "school") {
            return redirect("school-dashboard");
        } elseif ($usertype == "driver") {
            return redirect("d-dashboard");
        } elseif ($usertype == "student") {
            return redirect("s-dashboard");
        }
        return view('home');
    }
}

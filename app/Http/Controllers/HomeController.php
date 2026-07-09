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
            $url = "/a-dashboard";
        } elseif ($usertype == "school") {
            $url = "/school-dashboard";
        } elseif ($usertype == "driver") {
            $url = "/d-dashboard";
        } elseif ($usertype == "student") {
            $url = "/s-dashboard";
        }
        return view('home', compact('usertype','url'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        session()->forget('user');
        session()->forget('usertype');
        session()->forget('school_email');
        return redirect('login');
    }
}

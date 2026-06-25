<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        session()->forget('user');
        return redirect('login');
    }
}

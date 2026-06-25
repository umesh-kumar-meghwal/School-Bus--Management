<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class AdashboardController extends Controller
{
    public function adashboard()
    {
        $email = session('user');
        $usertype = session('usertype');
        if(!empty($email) && $usertype=='admin'){
        return view('a-dashboard',compact('email','usertype'));
        }else
        {
            return redirect('/error');
        }
    }
}
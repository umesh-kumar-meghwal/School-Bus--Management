<?php 
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ErrorController extends Controller
{
    public function error()
    {
        return view('error');
    }
}
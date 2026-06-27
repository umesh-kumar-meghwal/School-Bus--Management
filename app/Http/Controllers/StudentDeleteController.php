<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Login;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDeleteController extends Controller
{
  public function deletes()
  {
    return redirect('/error');
  }
  public function delete(Request $request)

  {
    $email = session('user');
    $usertype = session('usertype');
    if (!empty($email) && $usertype == 'admin' || $usertype =='school') {
      $email = $request->email;
      Student::where('email', $email)->delete();
      Login::where('email', $email)->delete();

      return Redirect('studentshow');
    } else {
      return redirect('/error');
    }
  }
}

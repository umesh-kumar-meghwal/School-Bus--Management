<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Login;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class StudentDeleteController extends Controller
{
  public function deletes()
  {
    return redirect('/error');
  }
  public function delete(Request $request)
  {
    $email_session = session('user');
    $usertype = session('usertype');

    if (!empty($email_session) && ($usertype == 'admin' || $usertype == 'school')) {

      $email_to_delete = $request->email;

      Student::where('email', $email_to_delete)->delete();
      Login::where('email', $email_to_delete)->delete();

      $school_email = $request->school_email;
      $data = DB::table('student')->where('school_email', Crypt::decryptString($request->school_email))->get();
      return view('studentshow', compact('data', 'school_email'));
    } else {
      return redirect('/error');
    }
  }
}

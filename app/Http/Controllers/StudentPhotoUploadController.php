<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\File;

class StudentPhotoUploadController extends Controller
{
    public function upload(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $email = $request->email;
            return view('uploadstudentphoto', compact('email'));
        } else {
            return redirect('/error');
        }
    }
    public function uploads(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $email = $request->email;
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            Student::where('email', $email)->update([
                'photo' => $filename
            ]);
            $msg = 'Photo Upload Success';
            return view('uploadstudentphoto', compact('msg', 'email'));
        } else {
            return redirect('/error');
        }
    }
    public function sphotochange(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $email  = $request->email;
            $p = $request->p;
            return view('sphotochange', compact('email', 'p'));
        } else {
            return redirect('/error');
        }
    }

    public function sphotochanges(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $email = $request->email;
            $p = $request->p;
            $filePath = public_path('uploads/' . $p);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            Student::where('email', $email)->update([
                'photo' => $filename
            ]);



            $msg = 'Photo Change Successfully';
            return view('sphotochange', compact('msg', 'email', 'p'));
        } else {
            return redirect('/error');
        }
    }
}

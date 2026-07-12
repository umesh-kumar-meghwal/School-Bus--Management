<?php

namespace  App\Http\Controllers;

use App\Models\App_updates;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;



class ApkController extends Controller
{
    public function apk(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            return view('apk-upload');
        } else {
            return redirect('/error');
        }
    }
    public function apk_upload(Request $request)
    {
        $email = session('user');
        $usertype = session('usertype');
        if (!empty($email) && $usertype == 'admin') {
            $file = $request->file('file');
            $file_name = $request->input('file_name');


            if (!$file) {
                return response()->json(['success' => 'No File Found']);
            }

            if ($file->getClientOriginalExtension() != "apk") {
                return response()->json(['success' => 'only APK file Support ! ', 'filename' => "❌" . $file->getClientOriginalExtension()]);
            }
            $name = $file_name . '.' . $file->getClientOriginalExtension();
            if (file_exists($name)) {
                unlink($name);
            }

            
            return response()->json(['success' => 'file upload successfully ', 'filename' => $name]);
        } else {
            return redirect('/error');
        }
    }
    
}

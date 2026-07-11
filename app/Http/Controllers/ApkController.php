<?php

namespace  App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;



class ApkController extends Controller
{
    public function apk(Request $request)
     {
        return view('apk-upload');
    }
    public function apk_upload(Request $request)
    {
        $file = $request->file('file');
        $file_name = $request->input('file_name');

        if($file->getClientOriginalExtension()!="apk"){
            return response()->json(['success'=>'only APK file Support ! ','filename'=>$file->getClientOriginalExtension()]);
        }
        $name = $file_name.'.'.$file->getClientOriginalExtension();
        if(file_exists($file)){
            unlink($file);
        }
        $file->move(public_path('downloads'),$name);
        return response()->json(['success'=>'file upload successfully ','filename'=>$name]);
    }
}

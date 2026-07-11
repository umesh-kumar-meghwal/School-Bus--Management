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

        if(!$file){
            return response()->json(['success'=>'No File Found']);

        }

        if($file->getClientOriginalExtension()!="apk"){
            return response()->json(['success'=>'only APK file Support ! ','filename'=>"❌". $file->getClientOriginalExtension()]);
        }
        $name = $file_name.$file->getClientOriginalExtension();
        $destination = public_path('uploads');
        $full_path = $destination.'/'.$name;
        if(file_exists($full_path)){
            unlink($full_path);
        }
        $file->move(public_path($destination, $name));
        return response()->json(['success'=>'file upload successfully ','filename'=>$name]);
    }
}

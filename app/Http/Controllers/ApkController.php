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
        $name = public_path('downloads').'transitflow'.'.'.$file->getClientOriginalExtension();
        if(file_exists($name)){
            unlink($name);
        }
        $file->move($name);
        return response()->json(['success'=>true,'filename'=>$name]);
    }
}

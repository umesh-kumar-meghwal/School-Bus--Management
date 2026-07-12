<?php

namespace  App\Http\Controllers;

use App\Models\App_updates;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;



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
            $apk_version = $request->input('apk_version');

            if (!$file) {
                return response()->json(['success' => 'No File Found']);
            }

            if ($file->getClientOriginalExtension() != "apk") {
                return response()->json(['success' => 'only APK file Support ! ', 'filename' => "❌" . $file->getClientOriginalExtension()]);
            }
            $path = public_path('uploads');

            

             if(File::exists($path)){
            foreach (File::files($path) as $oldFile) {
                if ($oldFile->getExtension() == 'apk') {
                    File::delete($oldFile->getPathname());
                }
            }
             }
            $name = $file_name . '.apk';


            $file->move($path, $name);
            App_updates::where('id', 1)->update([
                'latest_version' => $apk_version,
                'apk_path' => 'uploads/' . $name
            ]);
            return response()->json(['success' => 'file upload successfully ', 'filename' => $name]);
        } else {
            return redirect('/error');
        }
    }
}

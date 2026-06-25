<?php 
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
class DepartmentController extends Controller
{
    public function add_depart()
    {
        return view('add-department');
    }
    public function store(Request $request)
    {
        $depart_name = $request->depart_name;
        Department::create([
            'depart_name'=>$depart_name
        ]);
        $msg = "Department Add Successfully";
        return view('add-department',compact('msg'));

    }
    public function show()
    {
        $data = DB::table('department')->get();
        return view('show-department',compact('data'));
    }
    public function edit(Request $request)
    {
        $data = department::where('id',$request->id)->first();
        return view('department-edit',compact('data'));


    }
    public function edits(Request $request)
    {
        department::where('id',$request->id)->update([
            'depart_name'=>$request->depart_name
        ]);
        return redirect('/show-depart');
    }
    public function delete(Request $request)
    {
        $depart = department::where('id',$request->id)->first();
        student::where('depart_name',$depart->depart_name)->update(['depart_name'=>null]);
        $depart->delete();
        return redirect('/show-depart');
    }

}
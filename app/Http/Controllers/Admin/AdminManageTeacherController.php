<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AdminManageTeacherController extends Controller
{


    // View all teachers

    public function index()
    {
        $teachers = User::withTrashed()
                        ->where('role','teacher')
                        ->get();

        return view('admin.teachers.index',
        compact('teachers'));
    }




    // Add teacher page

    public function create()
    {
        return view('admin.teachers.create');
    }




    // Store teacher

    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'

        ]);


        User::create([

            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role'=>'teacher',
            'status'=>1

        ]);


        return redirect()
        ->route('admin.teachers')
        ->with('success','Teacher Added Successfully');

    }





    // Delete / Restore Toggle

    public function destroy($id)
    {

        $teacher = User::withTrashed()
                       ->findOrFail($id);


        if($teacher->trashed())
        {

            $teacher->restore();


            return back()
            ->with('success','Teacher Restored Successfully');

        }


        else
        {

            $teacher->delete();


            return back()
            ->with('success','Teacher Deleted Successfully');

        }

    }





    // Activate / Deactivate

    public function status($id)
    {

        $teacher = User::findOrFail($id);


        $teacher->status = !$teacher->status;


        $teacher->save();


        return back()
        ->with('success','Teacher status updated');

    }


}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index(){
        $teachers=Teacher::orderBy('id','desc')->get();
        return view('teacher.index',compact('teachers'));
    }//end method


    //store teacher
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ],[
            'name.required'=>'Name is required',
            'email.required'=>'Email is required',
        ]);


        Teacher::insert([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        return response()->json([
            'success'=>'Data inserted successfully',
        ]);
    }//end method


    //edit teacher
    public function edit($id){
        $teacher=Teacher::find($id);
        return response()->json($teacher);
    }//end method


    //update teacher
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ],[
            'name.required'=>'Name is required',
            'email.required'=>'Email is required',
        ]);



        $teacher=Teacher::find($id);
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->save();





        return response()->json([
            'success'=>'Data updated successfully',
        ]);
    }


        //delete teacher
        public function delete($id){
            Teacher::find($id)->delete();

            return response()->json([
                'success'=>'Data deleted successfully',
            ]);

    }//end method









}//end class

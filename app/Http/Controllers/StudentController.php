<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        $students=Student::orderBy('id','desc')->get();
        return view('student.index',compact('students'));
    }//end method


    //store student
    public function storeStudent(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
        ]);
        $student=new Student();

        $student->name=$request->name;
        $student->email=$request->email;
        $student->phone=$request->phone;
        $student->save();


        return response()->json(['message'=>'Data added successfully']);

    }//end method


    //edit student
    public function editStudent($id){
        $student=Student::find($id);
        return response()->json($student);
    }//end method


    //update student
    public function updateStudent(Request $request,$id){
        $student=Student::find($id);

        $student->name=$request->name;
        $student->email=$request->email;
        $student->phone=$request->phone;
        $student->save();

        return response()->json(['success'=>'Data updated successfully']);
    }//end method


    //delete student
    public function deleteStudent($id){
        $student=Student::find($id)->delete();
        return response()->json(['success'=>'Data deleted successfully']);
    }//end method





}//end class

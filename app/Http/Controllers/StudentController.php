<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;    

class StudentController extends Controller
{
    public function index(){
        return response()->json(Student::all(), 200);
    }

    public function show($id){

        $stud = Student::find($id);
        if(!$stud){
            return response()->json(['message'=>'Student not found'], 404);
        }
        return response()->json($stud , 200);
    }

    public function store(Request $req){
        $valData = $req->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'enrollment_number'=>'required|string|max:255',
            'department'=>'sometimes|string|max:255',
            'year'=>'required|numeric|min:0',
        ]);

        $stud = Student::create($valData);

        return response()->json($stud , 201);
    }



}

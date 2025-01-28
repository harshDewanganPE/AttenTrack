<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all(), 200);
    }

    public function show($id)
    {

        $stud = Student::find($id);
        if (!$stud) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($stud, 200);
    }


    public function store(Request $req)
    {
        $valData = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'enrollment_number' => 'required|string|max:255',
            'department' => 'sometimes|string|max:255',
            'year' => 'required|numeric|min:0',
        ]);

        $existingStudent = Student::where('enrollment_number', $valData['enrollment_number'])->first();

        if ($existingStudent) {
            return response()->json([
                'message' => 'Student with this enrollment number already exists.',
                'student' => $existingStudent,
            ], 409); // 409 Conflict HTTP status
        }

        $stud = Student::create($valData);

        return response()->json($stud, 201);
    }

    public function destroy($id)
    {
        $stud =  Student::find($id);
        if (!$stud) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $stud->delete();
        return response()->json(['message' => 'Student info deleted successfully'], 200);
    }


    public function update(Request $req, $id)
    {
        $stud = Student::find($id);
        if (!$stud) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $valData = $req->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'enrollment_number' => 'sometimes|required|string|max:255',
            'department' => 'sometimes|string|max:255',
            'year' => 'sometimes|required|numeric|min:0',
        ]);

        $stud->update($valData);
        return response()->json($stud, 200);
    }
}

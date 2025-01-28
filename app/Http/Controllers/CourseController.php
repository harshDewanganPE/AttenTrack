<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{

    public function index()
    {
        return response()->json(Course::all(), 200);
    }

    public function store(Request $req)
    {
        $valData = $req->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255',
        ]);

        $existingStudent = Course::where('course_code', $valData['course_code'])->first();

        if ($existingStudent) {
            return response()->json([
                'message' => 'Course with this Course Code already exists.',
                'student' => $existingStudent,
            ], 409); 
        }

        $stud = Course::create($valData);

        return response()->json($stud, 201);
    }

    public function show(string $id)
    {
        $stud = Course::find($id);
        if (!$stud) {
            return response()->json(['message' => 'Course not found'], 404);
        }
        return response()->json($stud, 200);
    }
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    public function destroy(string $id)
    {
        $stud =  Course::find($id);
        if (!$stud) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $stud->delete();
        return response()->json(['message' => 'Student info deleted successfully'], 200);
    }
}

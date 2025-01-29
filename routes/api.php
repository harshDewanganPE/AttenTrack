<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/hello', function () {
    return response()->json(['message' => 'Hello world! harsh']);
});

Route::apiResource('students', StudentController::class);

Route::apiResource('courses', CourseController::class);

Route::apiResource('attendances', AttendanceController::class);

Route::get('/attendances/{student_id}/{course_id}', [AttendanceController::class, 'presentForCourse']);

Route::post('/attendances/create', [AttendanceController::class, 'createAttendance']);





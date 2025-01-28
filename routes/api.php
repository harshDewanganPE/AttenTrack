<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/hello' , function(){
    return response()->json(['message' => 'Hello world! harsh']);
});

ROute::apiResource('students', StudentController::class );

ROute::apiResource('courses', CourseController::class );
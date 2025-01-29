<?php

namespace App\Http\Controllers;


use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function index()
    {
        return response()->json(Attendance::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'course_id' => 'required|integer|exists:courses,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:Present,Absent',
        ]);

        try {

            DB::insert(
                "INSERT INTO attendances (student_id, course_id, attendance_date, status, created_at, updated_at) 
                 VALUES (?, ?, ?, ?, NOW(), NOW())",
                [
                    $validated['student_id'],
                    $validated['course_id'],
                    $validated['attendance_date'],
                    $validated['status']
                ]
            );

            return response()->json([
                'message' => 'Attendance record created successfully',
                'data' => $validated
            ], 201);
        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Failed to create attendance record',
                'details' => $e->getMessage(),
            ], 400);
        }
    }


    public function presentForCourse($student_id, $course_id)
    {
        $sqlq = "
            SELECT attendance_date, status 
            FROM attendances 
            WHERE student_id = ? AND course_id = ?
            ";

        $attendances = DB::select(
            $sqlq,
            [$student_id, $course_id]
        );

        if (empty($attendances)) {
            return response()->json([
                'message' => 'No attendance records found for the specified student and course.',
            ], 404);
        }

        $presentDates = [];
        $absentDates = [];

        foreach ($attendances as $attendance) {
            if ($attendance->status === 'Present') {
                $presentDates[] = $attendance->attendance_date;
            } else {
                $absentDates[] = $attendance->attendance_date;
            }
        }

        return response()->json([
            'student_id' => $student_id,
            'course_id' => $course_id,
            'present_dates' => $presentDates,
            'absent_dates' => $absentDates,
        ], 200);
    }


    public function createAttendance(Request $request)
    {
        
        $validated = $request->validate([
            'course_code' => 'required|string|exists:courses,course_code',
            'attendance_date' => 'required|date',
            'present_enrollment_number' => 'required|array',
            'present_enrollment_number.*' => 'integer|exists:students,enrollment_number',
            'absent_enrollment_number' => 'required|array',
            'absent_enrollment_number.*' => 'integer|exists:students,enrollment_number',
        ]);

        try {
            
            $course = DB::table('courses')->where('course_code', $validated['course_code'])->first();
            if (!$course) {
                return response()->json(['error' => 'Invalid course code.'], 400);
            }
            $course_id = $course->id;

            
            foreach ($validated['present_enrollment_number'] as $enrollment_number) {
                $student = DB::table('students')->where('enrollment_number', $enrollment_number)->first();
                if ($student) {
                    DB::insert(
                        "INSERT INTO attendances (student_id, course_id, attendance_date, status, created_at, updated_at) 
                     VALUES (?, ?, ?, 'Present', NOW(), NOW()) 
                     ON DUPLICATE KEY UPDATE status = 'Present', updated_at = NOW()",
                        [$student->id, $course_id, $validated['attendance_date']]
                    );
                }
            }

            
            foreach ($validated['absent_enrollment_number'] as $enrollment_number) {
                $student = DB::table('students')->where('enrollment_number', $enrollment_number)->first();
                if ($student) {
                    DB::insert(
                        "INSERT INTO attendances (student_id, course_id, attendance_date, status, created_at, updated_at) 
                     VALUES (?, ?, ?, 'Absent', NOW(), NOW()) 
                     ON DUPLICATE KEY UPDATE status = 'Absent', updated_at = NOW()",
                        [$student->id, $course_id, $validated['attendance_date']]
                    );
                }
            }

            return response()->json(['message' => 'Attendance records created successfully.', 'course_id' => $course_id], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create attendance records.',
                'details' => $e->getMessage(),
            ], 400);
        }
    }
}




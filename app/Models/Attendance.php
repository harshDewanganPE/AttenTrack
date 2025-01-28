<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'attendance_date',
        'status',
    ];

    /**
     * Define the relationship with the Student model.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Define the relationship with the Course model.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

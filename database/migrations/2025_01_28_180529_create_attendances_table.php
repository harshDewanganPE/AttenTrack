<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id('attendance_id'); // AUTO_INCREMENT primary key
            $table->unsignedBigInteger('student_id'); // Foreign key to Students table
            $table->unsignedBigInteger('course_id'); // Foreign key to Courses table
            $table->date('attendance_date'); // Attendance date
            $table->enum('status', ['Present', 'Absent']); // Status (Present/Absent)
            $table->timestamps(); // Created_at and updated_at timestamps

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
    
            
            $table->unique(['student_id', 'course_id', 'attendance_date']);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

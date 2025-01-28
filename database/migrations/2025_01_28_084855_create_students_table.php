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
    Schema::create('students', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->string('first_name', 50); // First name of the student
        $table->string('last_name', 50); // Last name of the student
        $table->string('enrollment_number', 50)->unique(); // Unique enrollment number
        $table->string('department', 100); // Department name
        $table->unsignedTinyInteger('year'); // Year of study (e.g., 1, 2, 3, 4)
        $table->timestamps(); // Created at and updated at timestamps
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

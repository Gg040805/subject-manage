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
            $table->id();
            $table->string('student_name');
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('teacher_id'); // Links to the teacher
            $table->unsignedBigInteger('subject_id'); // Links to the subject
            $table->timestamps();

            // Add foreign key constraints if necessary
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            // Uncomment if you want to enforce the foreign key for the subject
            // $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade'); 
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

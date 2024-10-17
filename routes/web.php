<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [loginController::class, 'showLoginForm'])->name('login');

// Route for handling login submissions
Route::post('/login', [loginController::class, 'login']);

// Route for logging out
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

// Protected routes for subjects
Route::middleware(['auth'])->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/{id}', [SubjectController::class, 'show'])->name('subjects.show'); // Assuming you have a show method for specific subjects
});
// Subject routes
Route::prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'index'])->name('subjects.index'); // List all subjects
    Route::get('subjects/create', [SubjectController::class, 'create'])->name('subjects.create'); // Show create form
    Route::post('/', [SubjectController::class, 'store'])->name('subjects.store'); // Store a new subject
    Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit'); // Show edit form
    Route::put('/{id}', [SubjectController::class, 'update'])->name('subjects.update'); // Update an existing subject
    Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy'); // Delete a subject
    Route::get('/{id}', [SubjectController::class, 'show'])->name('subjects.show'); // Show subject details
    Route::get('/students/all', [StudentController::class, 'allStudents'])->name('students.showall');
    Route::get('/subjects/{subject}/search', [SubjectController::class, 'search'])->name('subjects.show');
    
    Route::get('/subject/viewallteacher',[TeacherController::class,'showallteacher'])->name('viewallteacher');
  
    // Student routes under subjects
    Route::prefix('/{subject_id}/students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index'); // List all students
        Route::get('/create', [StudentController::class, 'create'])->name('students.create'); // Show create student form
        Route::post('/', [StudentController::class, 'store'])->name('students.store'); // Store a new student
        Route::get('/{studentId}', [StudentController::class, 'show'])->name('students.show'); // Show student details
        Route::get('/{studentId}/edit', [StudentController::class, 'edit'])->name('students.edit'); // Show edit student form
        Route::put('/{studentId}', [StudentController::class, 'update'])->name('students.update'); // Update a student
        Route::delete('/{studentId}', [StudentController::class, 'destroy'])->name('students.destroy'); // Delete a student
        
    

    });
     
    // Teacher routes under subjects
    Route::prefix('/{subject_id}/teachers')->group(function () {
        // List all teachers for a subject
        Route::get('/', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('/create', [TeacherController::class, 'create'])->name('teachers.create'); // Show form to create a new teacher
        Route::post('/', [TeacherController::class, 'store'])->name('teachers.store'); // Store a new teacher
        Route::get('/{teacher_id}', [TeacherController::class, 'show'])->name('teachers.show'); // Show teacher details
        Route::get('/{teacher_id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit'); // Show edit form
        Route::put('/{teacher_id}', [TeacherController::class, 'update'])->name('teachers.update'); // Update a teacher
        Route::delete('/{teacher_id}', [TeacherController::class, 'destroy'])->name('teachers.destroy'); // Delete a teacher
    });
});

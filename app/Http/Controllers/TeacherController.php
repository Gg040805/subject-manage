<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherController extends Controller
{
    public function index()
    {
        // Get the subject by its ID
        //$subject = Subject::findOrFail($subject_id);
    
        // Retrieve the students associated with the subject and eager load teachers
        //$students = Student::where('subject_id', $subject_id)->with('teacher')->get();
    
        // Retrieve all teachers and eager load the subjects they teach
        $teachers = Teacher::with('subject')->get();
    
        // Pass both the students, teachers, and the subject to the view
        return view('teachers.index', compact('teachers'));
    }

    public function showallteacher(){
         $teachers = Teacher::with('subject')->get();
        
         return view('teachers.index', compact('teachers'));
    }


    // Show the form to create a new teacher
   public function create($subject_id)
{
    $subject = Subject::findOrFail($subject_id); // Retrieve the subject by ID
    return view('teachers.create', compact('subject')); // Pass the subject and teachers to the view
}


    public function store(Request $request, $subject_id)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
        ]);
       
        $subject = Subject::where('id',$subject_id)->get(); // 

        Teacher::create([
            'teacher_name' => $request->teacher_name,
            'phone_number' => "6".$request->phone_number,
            'subject_id' => $subject_id,
        ]);

        return redirect()->route('teachers.index', $subject_id)->with('success', 'Teacher created successfully!');
    }

    // Display a specific teacher's details
    // TeachersController.php
    public function show($subject_id, $teacher_id)
{
    $teacher = Teacher::with('subject')
                      ->where('id', $teacher_id)
                      ->where('subject_id', $subject_id)
                      ->firstOrFail();

    return view('teachers.show', compact('teacher'));
}



    // Show the form to edit a specific teacher
    public function edit($subject_id, $teacher_id)
{
    // Retrieve the teacher and subjects
    $teacher = Teacher::with('subject')->findOrFail($teacher_id);
    $subjects = Subject::all();

    // Return the view with the teacher and subjects data
    return view('teachers.edit', compact('teacher', 'subjects'));
}
public function update(Request $request, $subject_id, $teacher_id)
{
    // Validate the incoming request data
    $request->validate([
        'teacher_name' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:15',
        'subject_id' => 'required|exists:subjects,id', // Ensure correct table name
    ]);

    // Find the teacher record by ID or fail
    $teacher = Teacher::findOrFail($teacher_id);

    // Prepend '6' to the phone number if provided
    if ($request->phone_number) {
        $request->merge(['phone_number' => '6' . $request->phone_number]);
    }

    // Update the teacher record with the validated data
    $teacher->update([
        'teacher_name' => $request->teacher_name,
        'phone_number' => $request->phone_number,
        'subject_id' => $request->subject_id,
    ]);

    // Redirect to the teacher index with a success message
    return redirect()->route('teachers.index', $subject_id)
                     ->with('success', 'Teacher updated successfully!');
}


    

    // Delete a specific teacher
    public function destroy($subject_id, $teacher_id)
{
    $teacher = Teacher::where('id', $teacher_id)
                      ->where('subject_id', $subject_id)
                      ->firstOrFail();

    // Delete the teacher
    $teacher->delete();

    return redirect()->route('teachers.index', ['subject_id' => $subject_id])
                     ->with('success', 'Teacher deleted successfully.');
}

        public function allTeachers()
    {
        // Retrieve all teachers and their associated subjects
        $teachers = Teacher::with('subject')->get(); // Adjust 'subject' according to your relationship

        return view('teachers.all', compact('teachers')); // Make sure the view exists
    }

    public function display($id)
{
    $teacher = Teacher::findOrFail($id); // Fetch the teacher by ID
    return view('teachers.show', compact('teacher')); // Return the view with teacher data
}


    
    


}

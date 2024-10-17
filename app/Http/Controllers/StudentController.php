<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher; // Ensure this is the correct case
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index($id)
    {
        $students = Student::where('subject_id', $id)->with('teacher')->get();
        $subject = Subject::findOrFail($id);
        return view('students.index', compact('students', 'subject'));
    }

    // Show the form to create a new student
    public function create($id)
    {
        $subject = Subject::findOrFail($id);
        $teachers = Teacher::where('subject_id', $id)->get();
        return view('students.create', compact('subject', 'teachers'));
    }

    // Store a newly created student
    public function store(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Student::create([
            'student_name' => $request->student_name,
            'phone_number' => "6" . $request->phone_number,
            'subject_id' => $id, // Associate student with the subject
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('students.index', $id)->with('success', 'Student created successfully!');
    }

    // Display a specific student's details
    public function show($id, $studentId)
{
    $student = Student::findOrFail($studentId);
    $subject = Subject::findOrFail($id);
    $teacher = $student->teacherid; 
    
    return view('students.show', compact('student', 'subject', 'teacher'));
}


    // Show the form to edit a specific student
    public function edit($subject_id, $studentId)
    {
        $student = Student::findOrFail($studentId);
        $subjects = Subject::all(); // Fetch all subjects
        $teachers = Teacher::all(); // Fetch all teachers
    
        return view('students.edit', compact('student', 'subjects', 'teachers'));
    }
    

    // Update a specific student's information
    public function update(Request $request, $id, $studentId)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $student = Student::findOrFail($studentId);

        if ($request->phone_number) {
            $request->merge(['phone_number' => '6' . $request->phone_number]);
        }

        $student->update($request->all());

        return redirect()->route('students.index', $id)->with('success', 'Student updated successfully!');
    }

    // Delete a specific student
    public function destroy(Request $request, $id, $studentId = null)
    {
        if ($request->has('student_ids')) {
            $studentIds = $request->input('student_ids');
            $subject_id = Student::findOrFail($studentIds[0])->subject_id;

            Student::whereIn('id', $studentIds)->delete();

            return redirect()->route('students.index', $subject_id)->with('success', 'Selected students deleted successfully!');
        }

        $student = Student::findOrFail($studentId);
        $subject_id = $student->subject_id;
        $student->delete();

        return redirect()->route('students.index', $subject_id)->with('success', 'Student deleted successfully!');
    }
    public function allStudents()
{
    // Load students along with their subjects and teachers
    $students = Student::with(['subject', 'teacher'])->get();

    // Pass the students data to the view
    return view('students.showall', compact('students'));
}



}

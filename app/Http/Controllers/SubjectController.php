<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Get the search query

        if ($query) {
            // Search subjects, teachers, and students
            $subjects = Subject::where('subject_name', 'like', '%' . $query . '%')
                ->orWhereHas('teachers', function ($q) use ($query) {
                    $q->where('teacher_name', 'like', '%' . $query . '%');
                })
                ->orWhereHas('students', function ($q) use ($query) {
                    $q->where('student_name', 'like', '%' . $query . '%');
                })->get();
        } else {
            // If no search query, display all subjects
            $subjects = Subject::all();
        }

        $students = Student::all();
        $teachers = Teacher::all();

        return view('subjects.index', compact('subjects', 'students', 'teachers', 'query'));
    }

    
    public function create()
    {
        return view('subjects.create'); // Make sure this view file exists
    }

    // Store a newly created subject
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
        ]);

        Subject::create([
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }  
    public function edit($id)
{
    // Find the subject by ID
    $subject = Subject::findOrFail($id);
    
    // Get all teachers to populate the dropdown
    $teachers = Teacher::all();

    // Pass both the subject and teachers to the view
    return view('subjects.edit', compact('subject', 'teachers'));
}

public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'subject_name' => 'required|string|max:255|unique:subjects,subject_name,' . $id,
    ]);

    // Find the subject by ID
    $subject = Subject::findOrFail($id);

    // Update the subject name
    $subject->subject_name = $request->input('subject_name');
    $subject->save();

    // Redirect back with a success message
    return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
}





 
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
    
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
    public function show($id)
{
    $subject = Subject::findOrFail($id);
    $teachers = $subject->teachers; // Assuming you have a relationship set up for teachers
    $students = $subject->student; // Assuming a relationship exists for students
    //dd($subject,$teachers,$students);
    return view('subjects.show', compact('subject', 'teachers', 'students'));
}
public function search(Request $request, $subjectId)
{
    $query = $request->input('query');

    // Fetch the subject to return to the view
    $subject = Subject::findOrFail($subjectId);

    // Search for teachers and students based on the query
    $teachers = Teacher::where('subject_id', $subjectId)
        ->where('teacher_name', 'LIKE', "%$query%")
        ->get();

    $students = Student::where('subject_id', $subjectId)
        ->where('student_name', 'LIKE', "%$query%")
        ->get();

    // Return the view with search results
    return view('subjects.show', compact('teachers', 'students', 'subject'));
}




}

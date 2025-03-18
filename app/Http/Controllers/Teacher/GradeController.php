<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $students = Student::where('teacher_id', $teacher->id)->with('grades')->get();

        return view('teacher.grades.index', compact('students'));
    }

    public function create($studentId)
    {
        $student = Student::findOrFail($studentId);
        return view('teacher.grades.create', compact('student'));
    }

    public function store(Request $request, $studentId)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'marks' => 'required|numeric|min:0|max:100',
        ]);

        $grade = new Grade();
        $grade->student_id = $studentId;
        $grade->subject_id = $request->subject_id;
        $grade->marks = $request->marks;
        $grade->teacher_id = Auth::id();
        $grade->save();

        return redirect()->route('teacher.grades.index')->with('success', 'Grade assigned successfully.');
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        return view('teacher.grades.edit', compact('grade'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'marks' => 'required|numeric|min:0|max:100',
        ]);

        $grade = Grade::findOrFail($id);
        $grade->marks = $request->marks;
        $grade->save();

        return redirect()->route('teacher.grades.index')->with('success', 'Grade updated successfully.');
    }

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('teacher.grades.index')->with('success', 'Grade deleted successfully.');
    }
}
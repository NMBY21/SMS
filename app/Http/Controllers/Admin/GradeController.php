<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\Grade;
// use Illuminate\Http\Request;

// class GradeController extends Controller
// {
//     public function index()
//     {
//         $grades = Grade::all();
//         return view('admin.grades.index', compact('grades'));
//     }

//     public function create()
//     {
//         return view('admin.grades.create');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'student_id' => 'required|exists:students,id',
//             'subject_id' => 'required|exists:subjects,id',
//             'marks' => 'required|numeric|min:0|max:100',
//         ]);

//         Grade::create($request->all());
//         return redirect()->route('admin.grades.index')->with('success', 'Grade added successfully.');
//     }

//     public function edit(Grade $grade)
//     {
//         return view('admin.grades.edit', compact('grade'));
//     }

//     public function update(Request $request, Grade $grade)
//     {
//         $request->validate([
//             'marks' => 'required|numeric|min:0|max:100',
//         ]);

//         $grade->update($request->all());
//         return redirect()->route('admin.grades.index')->with('success', 'Grade updated successfully.');
//     }

//     public function destroy(Grade $grade)
//     {
//         $grade->delete();
//         return redirect()->route('admin.grades.index')->with('success', 'Grade deleted successfully.');
//     }
// }

// namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject', 'teacher'])->get();
        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        return view('admin.grades.create', [
            'students' => Student::all(),
            'subjects' => Subject::all(),
            'teachers' => Teacher::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'marks' => 'required|integer|min:0|max:100',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade assigned successfully.');
    }

    public function edit(Grade $grade)
    {
        return view('admin.grades.edit', [
            'grade' => $grade,
            'students' => Student::all(),
            'subjects' => Subject::all(),
            'teachers' => Teacher::all(),
        ]);
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'marks' => 'required|integer|min:0|max:100',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
}

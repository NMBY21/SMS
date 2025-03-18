<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('teacher.students.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('teacher.students.show', compact('student'));
    }
}
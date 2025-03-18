<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        $grades = Grade::where('student_id', $student->id)->with('subject')->get();

        return view('student.grades.index', compact('grades'));
    }
}
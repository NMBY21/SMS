<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GradeController as AdminGradeController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Teacher\GradeController as TeacherGradeController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Student\GradeController as StudentGradeController;

// Admin routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('admin/teachers', AdminTeacherController::class);
    Route::apiResource('admin/students', AdminStudentController::class);
    Route::apiResource('admin/subjects', AdminSubjectController::class);
    Route::apiResource('admin/grades', AdminGradeController::class);
});

// Teacher routes
Route::middleware(['auth:sanctum', 'role:teacher'])->group(function () {
    Route::apiResource('teacher/students', TeacherStudentController::class);
    Route::post('teacher/students/{student}/grades', [TeacherGradeController::class, 'store']);
    Route::get('teacher/students/{student}/grades', [TeacherGradeController::class, 'index']);
});

// Student routes
Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('student/grades', [StudentGradeController::class, 'index']);
});
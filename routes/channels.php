<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('grades.{studentId}', function ($user, $studentId) {
    return $user->id === $studentId || $user->hasRole('admin');
});

Broadcast::channel('students.{teacherId}', function ($user, $teacherId) {
    return $user->hasRole('teacher') && $user->id === $teacherId;
});
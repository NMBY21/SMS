<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject_id', 'teacher_id', 'marks'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id'); }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');  }

    public function subject()
    {
        return $this->belongsTo(Subject::class);   }
}
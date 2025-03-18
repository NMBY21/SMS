<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'evaluation_score',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // Correct relationship to User model
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

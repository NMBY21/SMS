<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'subject_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
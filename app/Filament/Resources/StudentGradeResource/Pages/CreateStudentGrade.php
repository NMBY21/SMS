<?php

namespace App\Filament\Resources\StudentGradeResource\Pages;

use App\Filament\Resources\StudentGradeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentGrade extends CreateRecord
{
    protected static string $resource = StudentGradeResource::class;
}

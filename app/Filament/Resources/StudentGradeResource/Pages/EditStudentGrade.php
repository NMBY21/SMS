<?php

namespace App\Filament\Resources\StudentGradeResource\Pages;

use App\Filament\Resources\StudentGradeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentGrade extends EditRecord
{
    protected static string $resource = StudentGradeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

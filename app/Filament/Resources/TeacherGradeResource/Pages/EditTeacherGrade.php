<?php

namespace App\Filament\Resources\TeacherGradeResource\Pages;

use App\Filament\Resources\TeacherGradeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacherGrade extends EditRecord
{
    protected static string $resource = TeacherGradeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\StudentGradeResource\Pages;

use App\Filament\Resources\StudentGradeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentGrades extends ListRecords
{
    protected static string $resource = StudentGradeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\TeacherEvaluationResource\Pages;

use App\Filament\Resources\TeacherEvaluationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacherEvaluation extends EditRecord
{
    protected static string $resource = TeacherEvaluationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

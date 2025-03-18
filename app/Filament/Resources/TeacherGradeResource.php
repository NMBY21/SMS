<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherGradeResource\Pages;
use App\Models\TeacherGrade;
use App\Models\User;  // Import User model for teacher selection
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class TeacherGradeResource extends Resource
{
    protected static ?string $model = TeacherGrade::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Teacher Evaluations';
    

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Evaluate Teacher')->schema([
                Select::make('teacher_id')
                    ->label('Teacher')
                    ->options(
                        User::whereHas('roles', function ($query) {
                            $query->where('name', 'teacher');
                        })->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),

                Select::make('subject_id')
                    ->label('Subject')
                    ->options(
                        Subject::pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),

                TextInput::make('evaluation_score')
                    ->label('Evaluation Score')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('teacher.name')->label('Teacher')->sortable()->searchable(),
            TextColumn::make('subject.name')->label('Subject')->sortable()->searchable(),
            TextColumn::make('evaluation_score')->label('Evaluation Score')->sortable(),
            
            
        
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeacherGrades::route('/'),
            'create' => Pages\CreateTeacherGrade::route('/create'),
            'edit' => Pages\EditTeacherGrade::route('/{record}/edit'),
        ];
    }
}

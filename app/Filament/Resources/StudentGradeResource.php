<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentGradeResource\Pages;
use App\Models\StudentGrade;
use App\Models\User;
use App\Models\Subject; // Import the Subject model
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class StudentGradeResource extends Resource
{
    protected static ?string $model = StudentGrade::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Student Grades';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Assign Grade to Student')->schema([
                Select::make('student_id')
                    ->label('Student')
                    ->options(
                        User::whereHas('roles', function ($query) {
                            $query->where('name', 'student');
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

                Select::make('teacher_id')
                    ->label('Assigned By (Teacher)')
                    ->options(
                        User::whereHas('roles', function ($query) {
                            $query->where('name', 'teacher');
                        })->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),

                TextInput::make('marks')
                    ->label('Marks')
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
            TextColumn::make('student.name')->label('Student')->sortable()->searchable(),
            TextColumn::make('subject.name')->label('Subject')->sortable()->searchable(),
            TextColumn::make('teacher.name')->label('Assigned By')->sortable()->searchable(),
            TextColumn::make('marks')->label('Marks')->sortable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentGrades::route('/'),
            'create' => Pages\CreateStudentGrade::route('/create'),
            'edit' => Pages\EditStudentGrade::route('/{record}/edit'),
        ];
    }
}
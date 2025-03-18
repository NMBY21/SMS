<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherEvaluationResource\Pages;
use App\Models\TeacherEvaluation;
use App\Models\User;
use App\Models\Subject;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;

class TeacherEvaluationResource extends Resource
{
    protected static ?string $model = TeacherEvaluation::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Admin';
    protected static ?string $navigationLabel = 'Teacher Evaluations';

    /**
     * Only show in navigation if user is an admin.
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('admin'); // Hide from students & teachers
    }

    /**
     * Only allow admins to view this resource.
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin'); // Prevents manual URL access
    }

    /**
     * Disable create functionality for all users.
     */
    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('admin'); // Only admins can create (optional)
    }

    /**
     * Disable editing for all users.
     */
    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole('admin'); // Only admins can edit (optional)
    }

    /**
     * Disable deletion for all users.
     */
    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('admin'); // Only admins can delete (optional)
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Evaluation Details')->schema([
                Select::make('teacher_id')
                    ->label('Teacher')
                    ->options(
                        User::whereHas('roles', function ($query) {
                            $query->where('name', 'teacher');
                        })->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required()
                    ->disabled(), // Make selection read-only

                Select::make('subject_id')
                    ->label('Subject')
                    ->options(
                        Subject::pluck('name', 'id')
                    )
                    ->searchable()
                    ->required()
                    ->disabled(), // Make selection read-only

                TextInput::make('evaluation_score')
                    ->label('Evaluation Score')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->disabled(), // Make input read-only
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeacherEvaluations::route('/'),
        ];
    }
}

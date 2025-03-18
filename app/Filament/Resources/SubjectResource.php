<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Models\Subject;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('admin'); // Only show for admin
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Subject Name')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('Description')
                ->maxLength(500),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Subject Name')
                ->sortable()
                ->searchable(),
            
            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->sortable()
                ->searchable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}



// <!-- 

// namespace App\Filament\Resources;

// use App\Filament\Resources\SubjectResource\Pages;
// use App\Models\Subject;
// use Filament\Resources\Form;
// use Filament\Resources\Resource;
// use Filament\Resources\Table;
// use Filament\Tables;
// use Filament\Forms\Components\TextInput;
// use Filament\Forms\Components\Textarea;

// class SubjectResource extends Resource
// {
//     protected static ?string $model = Subject::class;
//     protected static ?string $navigationIcon = 'heroicon-o-book-open';
    
//     public static function form(Form $form): Form
//     {
//         return $form->schema([
//             TextInput::make('name')
//                 ->label('Subject Name')
//                 ->required()
//                 ->maxLength(255),

//             Textarea::make('description')
//                 ->label('Description')
//                 ->maxLength(500),
//         ]);
//     }

//     public static function table(Table $table): Table
//     {
//         return $table->columns([
//             Tables\Columns\TextColumn::make('name')
//                 ->label('Subject Name')
//                 ->sortable()
//                 ->searchable(),
            
//             Tables\Columns\TextColumn::make('description')
//                 ->label('Description')
//                 ->sortable()
//                 ->searchable(),
//         ])
//         ->filters([
//             // Filters can be added here if necessary
//         ]);
//     }

//     public static function getPages(): array
//     {
//         return [
//             'index' => Pages\ListSubjects::route('/'),
//             'create' => Pages\CreateSubject::route('/create'),
//             'edit' => Pages\EditSubject::route('/{record}/edit'),
//         ];
//     }
// } -->

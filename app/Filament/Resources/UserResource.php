<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Filament\Tables\Columns\TextColumn;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('User Details')->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->unique('users', 'email', ignoreRecord: true),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->maxLength(255)
                    ->nullable() // Password is nullable when editing
                    ->required(fn ($record) => $record === null), // Password is required when creating a new user

                Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload(),

                // Subject assignment (MultiSelect to assign multiple subjects)
                Select::make('subjects') // This is for assigning subjects to teachers
                    ->label('Assign Subjects')
                    ->relationship('subjects', 'name')  // Relationship with subjects
                    ->multiple() // Allow selecting multiple subjects
                    ->preload(), // Preload all available subjects to improve performance

                Checkbox::make('is_active')
                    ->label('Active'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),

            TextColumn::make('roles.name')
                ->label('Role')
                ->color('primary')
                ->sortable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public function save()
    {
        $this->record->syncRoles($this->roles);
        parent::save();
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public function update(User $user, Request $request)
    {
        $data = $request->only(['name', 'email', 'roles', 'is_active']);

        // Only update password if a new one is provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']); // Prevent overwriting with null
        }

        $user->update($data);
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index');
    }
}

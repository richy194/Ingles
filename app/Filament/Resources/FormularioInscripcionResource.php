<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormularioInscripcionResource\Pages;
use App\Models\FormularioInscripcion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class FormularioInscripcionResource extends Resource
{
    protected static ?string $model = FormularioInscripcion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->required()
                    ->password(),

                Forms\Components\TextInput::make('Documento')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('direccion')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\Select::make('role_id')
                    ->relationship('roles', 'name') // Asumiendo que ya tienes una relación con la tabla roles
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('Documento'),
                Tables\Columns\TextColumn::make('direccion'),
                Tables\Columns\TextColumn::make('telefono'),
                Tables\Columns\TextColumn::make('roles.name'), // Asegúrate de tener la relación correcta
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at') 
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([ 
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('inscribir')
                    ->action(function (FormularioInscripcion $record) {
                        // Crear el usuario
                        $user = User::create([
                            'name' => $record->name,
                            'email' => $record->email,
                            'password' => Hash::make($record->password),
                            'role_id' => $record->role_id, // Asigna el rol
                        ]);
                        // Crear el estudiante
                        Student::create([
                            'Documento' => $record->Documento, // Asegúrate de que este campo está en el formulario
                            'user_id' => $user->id, // Asigna el ID del usuario creado
                            'direccion' => $record->direccion,
                            'correo' => $record->email, // Cambia si es necesario
                            'telefono' => $record->telefono,
                        ]);

                        // Puedes añadir lógica adicional aquí, como redirigir o mostrar un mensaje.
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check'),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(), 
            ])
            ->filters([
                //
                Tables\Filters\TrashedFilter::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormularioInscripcions::route('/'),
            'create' => Pages\CreateFormularioInscripcion::route('/create'),
            'edit' => Pages\EditFormularioInscripcion::route('/{record}/edit'),
        ];
    }
}

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
use App\Models\Theacher;
use App\Models\Curso;
use App\Models\Matricula;
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
                    
                Forms\Components\DatePicker::make('fecha_matricula')
                ->required(),
                Forms\Components\Select::make('estado')
                    ->required()
                    ->options([
                        'aprobado' => 'aprobado',
                        'habilitacion' => 'habilitacion',
                        'inscrito' => 'inscrito',
                        'cursando' => 'cursando ',
                    ]),
                    Forms\Components\TextInput::make('nota_final')
                    ->required()
                    ->numeric(),
                    Forms\Components\Select::make('teacher_id')
                    ->required() // Opcional, según tus necesidades
                    ->options(Theacher::all()->pluck('nombre', 'id')) // Usa 'nombre' para el select
                    ->label('Profesor')
                    ->placeholder('Selecciona un profesor'),
                    Forms\Components\Select::make('grupo_id')
                    ->required()
                    ->options(Curso::all()->pluck('nombre', 'id')) // Usa 'name' para el select
                    ->label('curso')
                    ->placeholder('Selecciona tu curso '),
                    
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
                Tables\Columns\TextColumn::make('fecha_matricula'),
                Tables\Columns\TextColumn::make('estado'),
                Tables\Columns\TextColumn::make('nota_final'),
                Tables\Columns\TextColumn::make('theacher.nombre')
                    ->numeric()
                    ->label('Profesor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('curso.nombre')
                    ->numeric()
                    ->label('curso')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('curso.nivel_curso')
                    ->numeric()
                    ->label('nivel del curso')
                    ->sortable(),
                 // Asegúrate de tener la relación correcta
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
                        Matricula::create([
                            'name'=> $record->name,
                            'email'=> $record->email,
                            'Documento' => $record->Documento, // Asegúrate de que este campo está en el formulario
                            'direccion' => $record->direccion,
                            'telefono' => $record->telefono,
                            'fecha_matricula'=> $record->fecha_matricula,
                             'estado'=> $record->estado,
                             'nota_final'=> $record->nota_final,
                             'teacher_id'=> $record->teacher_id,
                            'grupo_id'=> $record->grupo_id,
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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

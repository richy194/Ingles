<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursoResource\Pages;
use App\Filament\Resources\CursoResource\RelationManagers;
use App\Models\Curso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Semestre;
use App\Models\Theacher;                          

use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CursoResource extends Resource
{
    protected static ?string $model = Curso::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('nivel_curso')
                    ->required()
                    ->options([
                        'A1' => 'A1',
                        'A2' => 'A2',
                        'B1' => 'B1',
                        'B2' => 'B2',
                        'C1' => 'C1',
                        'C2' => 'C2',
                    ])
                    ->default(1) // Establecer un valor predeterminado, si es necesario
                    ->reactive() // Opcional
                    ->label('Nivel del Curso'), // Etiqueta para el campo
                Forms\Components\DatePicker::make('fecha_inicio')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_fin')
                    ,
                    Forms\Components\TextInput::make('requisito')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('modalidad')
                    ->required()
                    ->options([
                        'presencial' => 'presencial',
                        'virtual' => 'virtual',
                     
                    ]),

                    Forms\Components\Select::make('semestre_id')
                    ->required()
                    ->options(Semestre::all()->pluck('nombre', 'id')) // Usa 'nombre' para mostrar en el select
                    ->label('Semestre')
                    ->placeholder('Selecciona un semestre'), // Texto que se muestra cuando no hay selección
                    // Opcional, si necesitas que el select afecte otros campos
                    Forms\Components\Select::make('teacher_id')
                    ->required() // Opcional, según tus necesidades
                    ->options(Theacher::all()->pluck('nombre', 'id')) // Usa 'nombre' para el select
                    ->label('Profesor')
                    ->placeholder('Selecciona un profesor'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
                 Tables\Columns\TextColumn::make('nivel_curso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('requisito')
                    ->searchable(),
                 Tables\Columns\TextColumn::make('modalidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('semestre.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                Tables\Filters\TrashedFilter::make(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\RestoreAction::make(), 
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCurso::route('/create'),
            'edit' => Pages\EditCurso::route('/{record}/edit'),
        ];
    }
}

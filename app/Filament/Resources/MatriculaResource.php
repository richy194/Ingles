<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatriculaResource\Pages;
use App\Filament\Resources\MatriculaResource\RelationManagers;
use App\Models\Matricula;
use Filament\Forms;
use App\Models\User;
use App\Models\Theacher;
use App\Models\Curso;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class MatriculaResource extends Resource
{
    protected static ?string $model = Matricula::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('fecha_matricula')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_matricula_final')
                    ->required(),
                    Forms\Components\Select::make('estado')
                    ->required()
                    ->options([
                        'aprobado' => 'aprobado',
                        'habilitacion' => 'habilitacion',
                        'inscrito' => 'inscrito',
                        'cursando' => 'cursando ',
                    ])
                    ->default('cursando') // Opcional
                    ->reactive() // Opcional
                    ->label('estado'),
                Forms\Components\Select::make('aplazado')
                ->required()
                ->options([
                    'si' => 'si',
                    'no' => 'no',
                    
                ])
                ->default('no') // Opcional
                ->label('Aplazado'),
                Forms\Components\TextInput::make('nota_final')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('estudiante_id')
                    ->required()
                    ->label('estudiante'),
                   
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
                Tables\Columns\TextColumn::make('id')
                    
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_matricula')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_matricula_final')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('aplazado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nota_final')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.Documento')
                    ->numeric()
                    ->label('documento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.nombre')
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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
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
            'index' => Pages\ListMatriculas::route('/'),
            'create' => Pages\CreateMatricula::route('/create'),
            'edit' => Pages\EditMatricula::route('/{record}/edit'),
        ];
    }
}

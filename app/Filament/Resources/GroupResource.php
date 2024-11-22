<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Filament\Resources\GroupResource\RelationManagers;
use App\Models\Group;
use App\Models\Curso;
use App\Models\PeriodoAcademico;
use App\Models\Theacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('curso_id')
                ->label('Curso')
                ->options(Curso::all()->pluck('nombre', 'id')) // Obtener todos los cursos y mostrar su nombre
                ->required()
                ->searchable(),
                Forms\Components\Select::make('periodo_id')
                ->label('Periodo Académico')
                    ->options(PeriodoAcademico::all()->pluck('nombre', 'id')) // Obtener todos los periodos académicos y mostrar su nombre
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric(),
                    Forms\Components\Select::make('theacher_id')
                    ->label('Profesor ')
                        ->options(Theacher::all()->pluck('nombre', 'id')) // Obtener todos los periodos académicos y mostrar su nombre
                        ->required()
                        ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('curso.nombre') 
                    ->label('Curso')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('periodo_academicos.nombre') // Relacionado al nombre del periodo académico
                    ->label('Periodo Académico')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('theacher.nombre')
                    ->searchable(),
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}

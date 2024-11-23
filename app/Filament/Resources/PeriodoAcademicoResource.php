<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodoAcademicoResource\Pages;
use App\Filament\Resources\PeriodoAcademicoResource\RelationManagers;
use App\Models\PeriodoAcademico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeriodoAcademicoResource extends Resource
{
    protected static ?string $model = PeriodoAcademico::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('año')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('periodo')
                    ->required()
                    ->options([
                        'SEMESTRE-1' => 'SEMESTRE-1',
                        'SEMESTRE-2' => 'SEMESTRE-2',
                        'TRIMESTRE-1' => 'TRIMESTRE-1',
                        'TRIMESTRE-2' => 'TRIMESTRE-2',
                        'TRIMESTRE-3' => 'TRIMESTRE-3',
                        'TRIMESTRE-4' => 'TRIMESTRE-4',
                    ]),
                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('año')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('periodo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
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
            'index' => Pages\ListPeriodoAcademicos::route('/'),
            'create' => Pages\CreatePeriodoAcademico::route('/create'),
            'edit' => Pages\EditPeriodoAcademico::route('/{record}/edit'),
        ];
    }
}

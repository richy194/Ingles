<?php

namespace App\Filament\Resources\FormularioInscripcionResource\Pages;

use App\Filament\Resources\FormularioInscripcionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormularioInscripcions extends ListRecords
{
    protected static string $resource = FormularioInscripcionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

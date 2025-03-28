<?php

namespace App\Filament\Resources\FormularioInscripcionResource\Pages;

use App\Filament\Resources\FormularioInscripcionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFormularioInscripcion extends CreateRecord
{
    protected static string $resource = FormularioInscripcionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Resources\FormularioInscripcionResource\Pages;

use App\Filament\Resources\FormularioInscripcionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormularioInscripcion extends EditRecord
{
    protected static string $resource = FormularioInscripcionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

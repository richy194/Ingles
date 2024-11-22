<?php

namespace App\Filament\Resources\PeriodoAcademicoResource\Pages;

use App\Filament\Resources\PeriodoAcademicoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePeriodoAcademico extends CreateRecord
{
    protected static string $resource = PeriodoAcademicoResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

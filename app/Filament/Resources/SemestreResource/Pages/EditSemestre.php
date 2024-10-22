<?php

namespace App\Filament\Resources\SemestreResource\Pages;

use App\Filament\Resources\SemestreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSemestre extends EditRecord
{
    protected static string $resource = SemestreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

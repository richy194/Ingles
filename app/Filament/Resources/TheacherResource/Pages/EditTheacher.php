<?php

namespace App\Filament\Resources\TheacherResource\Pages;

use App\Filament\Resources\TheacherResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTheacher extends EditRecord
{
    protected static string $resource = TheacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

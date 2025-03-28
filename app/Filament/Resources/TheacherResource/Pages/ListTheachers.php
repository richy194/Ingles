<?php

namespace App\Filament\Resources\TheacherResource\Pages;

use App\Filament\Resources\TheacherResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTheachers extends ListRecords
{
    protected static string $resource = TheacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\BookEntryResource\Pages;

use App\Filament\Resources\BookEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookEntries extends ListRecords
{
    protected static string $resource = BookEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

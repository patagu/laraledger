<?php

namespace App\Filament\Resources\BookEntryResource\Pages;

use App\Filament\Resources\BookEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookEntry extends EditRecord
{
    protected static string $resource = BookEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

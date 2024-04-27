<?php

namespace App\Filament\Resources\BookEntryResource\Pages;

use App\Filament\Resources\BookEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookEntry extends CreateRecord
{
    protected static string $resource = BookEntryResource::class;
}

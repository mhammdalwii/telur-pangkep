<?php

namespace App\Filament\Peternak\Resources\PermintaanResource\Pages;

use App\Filament\Peternak\Resources\PermintaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermintaans extends ListRecords
{
    protected static string $resource = PermintaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

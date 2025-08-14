<?php

namespace App\Filament\Distributor\Resources\PengambilanResource\Pages;

use App\Filament\Distributor\Resources\PengambilanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengambilans extends ListRecords
{
    protected static string $resource = PengambilanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

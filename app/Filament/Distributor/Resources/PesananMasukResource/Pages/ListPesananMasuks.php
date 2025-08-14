<?php

namespace App\Filament\Distributor\Resources\PesananMasukResource\Pages;

use App\Filament\Distributor\Resources\PesananMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPesananMasuks extends ListRecords
{
    protected static string $resource = PesananMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

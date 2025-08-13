<?php

namespace App\Filament\Peternak\Resources\PanenResource\Pages;

use App\Filament\Peternak\Resources\PanenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanens extends ListRecords
{
    protected static string $resource = PanenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

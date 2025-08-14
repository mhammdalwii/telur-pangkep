<?php

namespace App\Filament\Distributor\Resources\PesananMasukResource\Pages;

use App\Filament\Distributor\Resources\PesananMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPesananMasuk extends EditRecord
{
    protected static string $resource = PesananMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

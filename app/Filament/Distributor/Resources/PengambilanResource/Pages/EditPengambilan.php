<?php

namespace App\Filament\Distributor\Resources\PengambilanResource\Pages;

use App\Filament\Distributor\Resources\PengambilanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengambilan extends EditRecord
{
    protected static string $resource = PengambilanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

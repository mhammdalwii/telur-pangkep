<?php

namespace App\Filament\Peternak\Resources\PermintaanResource\Pages;

use App\Filament\Peternak\Resources\PermintaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermintaan extends EditRecord
{
    protected static string $resource = PermintaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\PermohonanInformasi\Pages;

use App\Filament\Resources\PermohonanInformasi\PermohonanInformasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanInformasis extends ListRecords
{
    protected static string $resource = PermohonanInformasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Create action disabled karena permohonan berasal dari public form
            // Actions\CreateAction::make(),
        ];
    }
}

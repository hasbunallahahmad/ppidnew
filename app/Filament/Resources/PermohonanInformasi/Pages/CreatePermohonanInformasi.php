<?php

namespace App\Filament\Resources\PermohonanInformasi\Pages;

use App\Filament\Resources\PermohonanInformasi\PermohonanInformasiResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePermohonanInformasi extends CreateRecord
{
    protected static string $resource = PermohonanInformasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

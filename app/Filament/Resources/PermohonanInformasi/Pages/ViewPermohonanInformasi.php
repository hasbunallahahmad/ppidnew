<?php

namespace App\Filament\Resources\PermohonanInformasi\Pages;

use App\Filament\Resources\PermohonanInformasi\PermohonanInformasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPermohonanInformasi extends ViewRecord
{
    protected static string $resource = PermohonanInformasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
            Actions\Action::make('kembali')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(PermohonanInformasiResource::getUrl('index')),
        ];
    }
}

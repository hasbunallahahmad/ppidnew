<?php

namespace App\Filament\Resources\StatistikKunjungans\Pages;

use App\Filament\Resources\StatistikKunjungans\StatistikKunjunganResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStatistikKunjungan extends EditRecord
{
    protected static string $resource = StatistikKunjunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\StatistikKearsipans\Pages;

use App\Filament\Resources\StatistikKearsipans\StatistikKearsipanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStatistikKearsipan extends EditRecord
{
    protected static string $resource = StatistikKearsipanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

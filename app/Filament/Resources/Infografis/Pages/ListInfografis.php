<?php

namespace App\Filament\Resources\Infografis\Pages;

use App\Filament\Resources\Infografis\InfografisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInfografis extends ListRecords
{
    protected static string $resource = InfografisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

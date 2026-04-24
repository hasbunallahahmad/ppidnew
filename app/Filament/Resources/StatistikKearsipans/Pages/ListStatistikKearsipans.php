<?php

namespace App\Filament\Resources\StatistikKearsipans\Pages;

use App\Filament\Resources\StatistikKearsipans\StatistikKearsipanResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ListRecords;

class ListStatistikKearsipans extends ListRecords
{
    protected static string $resource = StatistikKearsipanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->slideOver()
                ->label('Tambah Statistik Baru')
                ->icon('heroicon-o-plus'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->slideOver(),  // 👈 SLIDE OVER EDIT
        ];
    }
}

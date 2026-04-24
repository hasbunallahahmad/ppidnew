<?php

namespace App\Filament\Resources\StatistikKunjungans\Pages;

use App\Filament\Resources\StatistikKunjungans\StatistikKunjunganResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListStatistikKunjungans extends ListRecords
{
    protected static string $resource = StatistikKunjunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->slideOver()  // 👈 SLIDE OVER CREATE
                ->label('Tambah Statistik Baru')
                ->icon('heroicon-o-plus')
                ->using(function (array $data, string $model): \Illuminate\Database\Eloquent\Model {
                    // Modifikasi data sebelum disimpan
                    $data['created_by'] = Auth::id();
                    $data['updated_by'] = Auth::id();

                    // Optional: validasi tambahan
                    if (empty($data['keterangan_periode'])) {
                        $data['keterangan_periode'] = $data['periode'] . ' - ' . now()->format('F Y');
                    }

                    return $model::create($data);
                }),
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

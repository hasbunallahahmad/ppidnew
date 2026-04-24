<?php

namespace App\Listeners;

use App\Events\DokumenUploaded;
use App\Filament\Resources\DokumenResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class NotifyAdminDokumenUploaded
{
    public function handle(DokumenUploaded $event): void
    {
        $dokumen  = $event->dokumen;
        $penerima = User::whereIn('role', ['admin', 'super_admin'])->get();

        Notification::make()
            ->title('Dokumen Baru Tersedia')
            ->body($dokumen->judul . ' (' . $dokumen->tipe_informasi_label . ') telah diaktifkan.')
            ->icon('heroicon-o-document-arrow-up')
            ->iconColor('info')
            ->actions([
                Action::make('lihat')
                    ->label('Lihat Dokumen')
                    ->url(DokumenResource::getUrl('edit', ['record' => $dokumen->getKey()]))
                    ->markAsRead(),
            ])
            ->sendToDatabase($penerima);
    }
}

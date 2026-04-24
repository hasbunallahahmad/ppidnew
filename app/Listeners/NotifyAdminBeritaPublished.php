<?php

namespace App\Listeners;

use App\Events\BeritaPublished;
use App\Filament\Resources\BeritaResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class NotifyAdminBeritaPublished
{
    public function handle(BeritaPublished $event): void
    {
        $berita   = $event->berita;
        $penerima = User::whereIn('role', ['admin', 'super_admin'])->get();

        Notification::make()
            ->title('Berita Baru Dipublikasikan')
            ->body($berita->judul . ' telah dipublish.')
            ->icon('heroicon-o-newspaper')
            ->iconColor('success')
            ->actions([
                Action::make('lihat')
                    ->label('Lihat Berita')
                    ->url(BeritaResource::getUrl('edit', ['record' => $berita->getKey()]))
                    ->markAsRead(),
            ])
            ->sendToDatabase($penerima);
    }
}

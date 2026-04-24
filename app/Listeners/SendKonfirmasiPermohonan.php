<?php

namespace App\Listeners;

use App\Events\PermohonanMasuk;
use App\Filament\Resources\PermohonanInformasiResource;
use App\Mail\KonfirmasiPermohonanMail;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendKonfirmasiPermohonan implements ShouldQueue
{
    public string $queue = 'emails';

    public function handle(PermohonanMasuk $event): void
    {
        $permohonan = $event->permohonan;

        Mail::to($permohonan->email)
            ->send(new KonfirmasiPermohonanMail($permohonan));

        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();

        Notification::make()
            ->title('Permohonan Informasi Baru')
            ->body('Dari: ' . $permohonan->nama_pemohon . ' | Tiket: ' . $permohonan->nomor_tiket)
            ->icon('heroicon-o-inbox-arrow-down')
            ->iconColor('warning')
            ->actions([
                Action::make('proses')
                    ->label('Proses Sekarang')
                    ->url(PermohonanInformasiResource::getUrl('edit', ['record' => $permohonan->getKey()]))
                    ->markAsRead(),
            ])
            ->sendToDatabase($admins);
    }

    public function failed(PermohonanMasuk $event, \Throwable $exception): void
    {
        Log::error('Gagal kirim email konfirmasi permohonan', [
            'nomor_tiket' => $event->permohonan->nomor_tiket,
            'email'       => $event->permohonan->email,
            'error'       => $exception->getMessage(),
        ]);
    }
}

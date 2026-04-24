<?php

namespace App\Mail;

use App\Models\PermohonanInformasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KonfirmasiPermohonanMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly PermohonanInformasi $permohonan
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Konfirmasi Permohonan Informasi – Tiket {$this->permohonan->nomor_tiket}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.konfirmasi-permohonan',
            with: [
                'permohonan' => $this->permohonan,
                'deadline'   => $this->permohonan->deadline_at?->translatedFormat('d F Y'),
            ],
        );
    }
}

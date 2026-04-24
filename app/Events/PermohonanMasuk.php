<?php

namespace App\Events;

use App\Models\PermohonanInformasi;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PermohonanMasuk
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly PermohonanInformasi $permohonan
    ) {}
}

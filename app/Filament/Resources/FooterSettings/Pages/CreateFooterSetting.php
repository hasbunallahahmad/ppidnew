<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFooterSetting extends CreateRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // The model's setAttribute will handle JSON encoding,
        // ensure proper format
        foreach (['section_1_menu', 'section_2_menu', 'section_3_menu'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = is_array($data[$field]) ? $data[$field] : [];
            }
        }
        return $data;
    }
}

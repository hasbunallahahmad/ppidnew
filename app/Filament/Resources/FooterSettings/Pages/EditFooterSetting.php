<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterSetting extends EditRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure menu fields are arrays, never strings or null
        foreach (['section_1_menu', 'section_2_menu', 'section_3_menu'] as $field) {
            if (!isset($data[$field]) || is_null($data[$field])) {
                $data[$field] = [];
            } elseif (is_string($data[$field])) {
                // Decode if it's a string
                $decoded = json_decode($data[$field], true);
                $data[$field] = is_array($decoded) ? $decoded : [];
            }
        }
        return $data;
    }
}

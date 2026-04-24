<?php

namespace App\Filament\Resources\HeroSettings;

use App\Filament\Resources\HeroSettings\Pages\CreateHeroSetting;
use App\Filament\Resources\HeroSettings\Pages\EditHeroSetting;
use App\Filament\Resources\HeroSettings\Pages\ListHeroSettings;
use App\Filament\Resources\HeroSettings\Schemas\HeroSettingForm;
use App\Filament\Resources\HeroSettings\Tables\HeroSettingsTable;
use App\Models\HeroSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HeroSettingResource extends Resource
{
    protected static ?string $model = HeroSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsVertical;

    protected static string|UnitEnum|null $navigationGroup = 'Halaman Statis';

    protected static ?string $navigationLabel = 'Pengaturan Hero';

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return HeroSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HeroSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHeroSettings::route('/'),
            'create' => CreateHeroSetting::route('/create'),
            'edit' => EditHeroSetting::route('/{record:slug}/edit'),
        ];
    }
}

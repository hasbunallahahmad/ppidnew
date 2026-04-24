<?php

namespace App\Filament\Resources\StatistikKunjungans;

use App\Filament\Resources\StatistikKunjungans\Pages\CreateStatistikKunjungan;
use App\Filament\Resources\StatistikKunjungans\Pages\EditStatistikKunjungan;
use App\Filament\Resources\StatistikKunjungans\Pages\ListStatistikKunjungans;
use App\Filament\Resources\StatistikKunjungans\Schemas\StatistikKunjunganForm;
use App\Filament\Resources\StatistikKunjungans\Tables\StatistikKunjungansTable;
use App\Models\StatistikKunjungan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StatistikKunjunganResource extends Resource
{
    protected static ?string $model = StatistikKunjungan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingLibrary;

    protected static string|UnitEnum|null $navigationGroup = 'Halaman Utama';

    protected static ?string $recordTitleAttribute = 'statistik-kunjungan';

    public static function form(Schema $schema): Schema
    {
        return StatistikKunjunganForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StatistikKunjungansTable::configure($table);
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
            'index' => ListStatistikKunjungans::route('/'),
            'create' => CreateStatistikKunjungan::route('/create'),
            'edit' => EditStatistikKunjungan::route('/{record}/edit'),
        ];
    }
}

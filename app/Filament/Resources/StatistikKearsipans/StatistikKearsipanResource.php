<?php

namespace App\Filament\Resources\StatistikKearsipans;

use App\Filament\Resources\StatistikKearsipans\Pages\ListStatistikKearsipans;
use App\Filament\Resources\StatistikKearsipans\Schemas\StatistikKearsipanForm;
use App\Filament\Resources\StatistikKearsipans\Tables\StatistikKearsipansTable;
use App\Models\StatistikKearsipan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StatistikKearsipanResource extends Resource
{
    protected static ?string $model = StatistikKearsipan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArchiveBoxXMark;

    protected static string|UnitEnum|null $navigationGroup = 'Halaman Utama';

    protected static ?string $recordTitleAttribute = 'statistik-kearsipan';

    public static function form(Schema $schema): Schema
    {
        return StatistikKearsipanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StatistikKearsipansTable::configure($table);
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
            'index' => ListStatistikKearsipans::route('/'),
            // 'create' => CreateStatistikKearsipan::route('/create'),
            // 'edit' => EditStatistikKearsipan::route('/{record}/edit'),
        ];
    }
}

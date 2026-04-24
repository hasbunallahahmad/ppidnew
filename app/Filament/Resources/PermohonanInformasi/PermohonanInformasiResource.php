<?php

namespace App\Filament\Resources\PermohonanInformasi;

use App\Filament\Resources\PermohonanInformasi\Pages\CreatePermohonanInformasi;
use App\Filament\Resources\PermohonanInformasi\Pages\EditPermohonanInformasi;
use App\Filament\Resources\PermohonanInformasi\Pages\ListPermohonanInformasis;
use App\Filament\Resources\PermohonanInformasi\Pages\ViewPermohonanInformasi;
use App\Filament\Resources\PermohonanInformasi\Schemas\PermohonanInformasiForm;
use App\Filament\Resources\PermohonanInformasi\Tables\PermohonanInformasisTable;
use App\Filament\Resources\PermohonanInformasi\Schemas\PermohonanInformasiInfolist;
use App\Models\PermohonanInformasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class PermohonanInformasiResource extends Resource
{
    protected static ?string $model = PermohonanInformasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxStack;

    protected static string|UnitEnum|null $navigationGroup = 'Halaman Utama';

    protected static ?string $navigationLabel = 'Permohonan Informasi';

    protected static ?string $modelLabel = 'Permohonan';

    protected static ?string $pluralModelLabel = 'Permohonan Informasi';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return PermohonanInformasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PermohonanInformasisTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PermohonanInformasiInfolist::configure($schema);
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
            'index' => ListPermohonanInformasis::route('/'),
            'create' => CreatePermohonanInformasi::route('/create'),
            'view' => ViewPermohonanInformasi::route('/{record}'),
            'edit' => EditPermohonanInformasi::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereIn('status', ['masuk', 'diproses'])->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::whereIn('status', ['masuk', 'diproses'])->count();
        return $count > 0 ? 'warning' : 'success';
    }
}

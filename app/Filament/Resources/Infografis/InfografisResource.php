<?php

namespace App\Filament\Resources\Infografis;

use App\Filament\Resources\Infografis\Pages\CreateInfografis;
use App\Filament\Resources\Infografis\Pages\EditInfografis;
use App\Filament\Resources\Infografis\Pages\ListInfografis;
use App\Filament\Resources\Infografis\Schemas\InfografisForm;
use App\Filament\Resources\Infografis\Tables\InfografisTable;
use App\Models\Infografis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InfografisResource extends Resource
{
    protected static ?string $model = Infografis::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'infografis';
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    public static function form(Schema $schema): Schema
    {
        return InfografisForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InfografisTable::configure($table);
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
            'index' => ListInfografis::route('/'),
            'create' => CreateInfografis::route('/create'),
            'edit' => EditInfografis::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

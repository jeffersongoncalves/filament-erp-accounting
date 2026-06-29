<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries;

use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Pages\ListGlEntries;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Pages\ViewGlEntry;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Schemas\GlEntryInfolist;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Tables\GlEntriesTable;

/**
 * Read-only viewer over the immutable general ledger. The ledger is written by
 * the domain lifecycle (submit/cancel); it is never created or edited here.
 */
class GlEntryResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 13;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'GL Entry';

    protected static ?string $pluralModelLabel = 'General Ledger';

    public static function getModel(): string
    {
        return ModelResolver::glEntry();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpAccountingPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-accounting.navigation_group', 'ERP — Accounting');
        }
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return GlEntryInfolist::configure($infolist);
    }

    public static function table(Table $table): Table
    {
        return GlEntriesTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGlEntries::route('/'),
            'view' => ViewGlEntry::route('/{record}'),
        ];
    }
}

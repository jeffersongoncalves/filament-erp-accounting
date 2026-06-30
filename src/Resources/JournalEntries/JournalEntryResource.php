<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages\CreateJournalEntry;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages\EditJournalEntry;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages\ListJournalEntries;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\RelationManagers\AccountsRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Schemas\JournalEntryForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Tables\JournalEntriesTable;

class JournalEntryResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 9;

    protected static ?string $recordTitleAttribute = 'naming_series';

    public static function getModel(): string
    {
        return ModelResolver::journalEntry();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpAccountingPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-accounting.navigation_group', 'ERP — Accounting');
        }
    }

    public static function form(Form $form): Form
    {
        return JournalEntryForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return JournalEntriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AccountsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJournalEntries::route('/'),
            'create' => CreateJournalEntry::route('/create'),
            'edit' => EditJournalEntry::route('/{record}/edit'),
        ];
    }
}

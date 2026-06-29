<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages\CreateSalesInvoice;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages\EditSalesInvoice;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages\ListSalesInvoices;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\RelationManagers\TaxesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Schemas\SalesInvoiceForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Tables\SalesInvoicesTable;

class SalesInvoiceResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCurrencyDollar;

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'customer_name';

    public static function getModel(): string
    {
        return ModelResolver::salesInvoice();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpAccountingPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-accounting.navigation_group', 'ERP — Accounting');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return SalesInvoiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalesInvoicesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
            TaxesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSalesInvoices::route('/'),
            'create' => CreateSalesInvoice::route('/create'),
            'edit' => EditSalesInvoice::route('/{record}/edit'),
        ];
    }
}

<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Pages\CreatePurchaseInvoice;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Pages\EditPurchaseInvoice;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Pages\ListPurchaseInvoices;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\RelationManagers\TaxesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Schemas\PurchaseInvoiceForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Tables\PurchaseInvoicesTable;

class PurchaseInvoiceResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentMinus;

    protected static ?int $navigationSort = 12;

    protected static ?string $recordTitleAttribute = 'supplier_name';

    public static function getModel(): string
    {
        return ModelResolver::purchaseInvoice();
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
        return PurchaseInvoiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PurchaseInvoicesTable::configure($table);
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
            'index' => ListPurchaseInvoices::route('/'),
            'create' => CreatePurchaseInvoice::route('/create'),
            'edit' => EditPurchaseInvoice::route('/{record}/edit'),
        ];
    }
}

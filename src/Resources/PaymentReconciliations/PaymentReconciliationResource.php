<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Models\PaymentReconciliation;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages\CreatePaymentReconciliation;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages\EditPaymentReconciliation;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages\ListPaymentReconciliations;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\RelationManagers\AllocationsRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Schemas\PaymentReconciliationForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Tables\PaymentReconciliationsTable;

class PaymentReconciliationResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static ?int $navigationSort = 16;

    protected static ?string $recordTitleAttribute = 'party_type';

    public static function getModel(): string
    {
        return PaymentReconciliation::class;
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
        return PaymentReconciliationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentReconciliationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AllocationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentReconciliations::route('/'),
            'create' => CreatePaymentReconciliation::route('/create'),
            'edit' => EditPaymentReconciliation::route('/{record}/edit'),
        ];
    }
}

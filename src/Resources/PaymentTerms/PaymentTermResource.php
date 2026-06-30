<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Pages\CreatePaymentTerm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Pages\EditPaymentTerm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Pages\ListPaymentTerms;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Schemas\PaymentTermForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Tables\PaymentTermsTable;

class PaymentTermResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::paymentTerm();
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
        return PaymentTermForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentTermsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentTerms::route('/'),
            'create' => CreatePaymentTerm::route('/create'),
            'edit' => EditPaymentTerm::route('/{record}/edit'),
        ];
    }
}

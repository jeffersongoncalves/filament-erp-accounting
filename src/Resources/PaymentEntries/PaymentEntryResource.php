<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Pages\CreatePaymentEntry;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Pages\EditPaymentEntry;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Pages\ListPaymentEntries;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Schemas\PaymentEntryForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Tables\PaymentEntriesTable;

class PaymentEntryResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'naming_series';

    public static function getModel(): string
    {
        return ModelResolver::paymentEntry();
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
        return PaymentEntryForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return PaymentEntriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentEntries::route('/'),
            'create' => CreatePaymentEntry::route('/create'),
            'edit' => EditPaymentEntry::route('/{record}/edit'),
        ];
    }
}

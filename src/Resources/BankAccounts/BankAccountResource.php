<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Pages\CreateBankAccount;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Pages\EditBankAccount;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Pages\ListBankAccounts;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Schemas\BankAccountForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Tables\BankAccountsTable;

class BankAccountResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'account_name';

    public static function getModel(): string
    {
        return ModelResolver::bankAccount();
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
        return BankAccountForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return BankAccountsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBankAccounts::route('/'),
            'create' => CreateBankAccount::route('/create'),
            'edit' => EditBankAccount::route('/{record}/edit'),
        ];
    }
}

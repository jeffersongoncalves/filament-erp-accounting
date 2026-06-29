<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Pages\CreateAccount;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Pages\EditAccount;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Pages\ListAccounts;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Schemas\AccountForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Tables\AccountsTable;

class AccountResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::account();
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
        return AccountForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return AccountsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccounts::route('/'),
            'create' => CreateAccount::route('/create'),
            'edit' => EditAccount::route('/{record}/edit'),
        ];
    }
}

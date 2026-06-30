<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
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
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

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

    public static function form(Schema $schema): Schema
    {
        return AccountForm::configure($schema);
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

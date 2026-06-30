<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Banks;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Banks\Pages\CreateBank;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Banks\Pages\EditBank;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Banks\Pages\ListBanks;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Banks\Schemas\BankForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Banks\Tables\BanksTable;

class BankResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::bank();
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
        return BankForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return BanksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBanks::route('/'),
            'create' => CreateBank::route('/create'),
            'edit' => EditBank::route('/{record}/edit'),
        ];
    }
}

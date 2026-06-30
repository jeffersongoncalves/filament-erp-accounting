<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Pages\CreateModeOfPayment;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Pages\EditModeOfPayment;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Pages\ListModesOfPayment;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Schemas\ModeOfPaymentForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Tables\ModesOfPaymentTable;

class ModeOfPaymentResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::modeOfPayment();
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
        return ModeOfPaymentForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ModesOfPaymentTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModesOfPayment::route('/'),
            'create' => CreateModeOfPayment::route('/create'),
            'edit' => EditModeOfPayment::route('/{record}/edit'),
        ];
    }
}

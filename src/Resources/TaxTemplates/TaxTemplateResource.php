<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\Pages\CreateTaxTemplate;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\Pages\EditTaxTemplate;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\Pages\ListTaxTemplates;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\RelationManagers\TaxesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\Schemas\TaxTemplateForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\Tables\TaxTemplatesTable;

class TaxTemplateResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::taxTemplate();
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
        return TaxTemplateForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return TaxTemplatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TaxesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTaxTemplates::route('/'),
            'create' => CreateTaxTemplate::route('/create'),
            'edit' => EditTaxTemplate::route('/{record}/edit'),
        ];
    }
}

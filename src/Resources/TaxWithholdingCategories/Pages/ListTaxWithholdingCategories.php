<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\TaxWithholdingCategoryResource;

class ListTaxWithholdingCategories extends ListRecords
{
    protected static string $resource = TaxWithholdingCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

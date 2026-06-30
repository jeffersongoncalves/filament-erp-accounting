<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\TaxWithholdingCategoryResource;

class CreateTaxWithholdingCategory extends CreateRecord
{
    protected static string $resource = TaxWithholdingCategoryResource::class;
}

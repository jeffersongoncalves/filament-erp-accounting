<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\TaxWithholdingCategoryResource;

class EditTaxWithholdingCategory extends EditRecord
{
    protected static string $resource = TaxWithholdingCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

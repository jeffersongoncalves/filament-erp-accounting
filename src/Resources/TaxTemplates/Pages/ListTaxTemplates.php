<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\TaxTemplateResource;

class ListTaxTemplates extends ListRecords
{
    protected static string $resource = TaxTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\TaxTemplateResource;

class EditTaxTemplate extends EditRecord
{
    protected static string $resource = TaxTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\PaymentTermResource;

class EditPaymentTerm extends EditRecord
{
    protected static string $resource = PaymentTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

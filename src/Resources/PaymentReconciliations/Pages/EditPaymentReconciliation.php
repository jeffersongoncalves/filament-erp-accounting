<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\PaymentReconciliationResource;

class EditPaymentReconciliation extends EditRecord
{
    protected static string $resource = PaymentReconciliationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\PaymentReconciliationResource;

class CreatePaymentReconciliation extends CreateRecord
{
    protected static string $resource = PaymentReconciliationResource::class;
}

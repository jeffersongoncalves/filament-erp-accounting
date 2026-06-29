<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\PaymentTermResource;

class CreatePaymentTerm extends CreateRecord
{
    protected static string $resource = PaymentTermResource::class;
}

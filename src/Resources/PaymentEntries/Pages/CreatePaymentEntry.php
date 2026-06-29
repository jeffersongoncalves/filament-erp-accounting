<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\PaymentEntryResource;

class CreatePaymentEntry extends CreateRecord
{
    protected static string $resource = PaymentEntryResource::class;
}

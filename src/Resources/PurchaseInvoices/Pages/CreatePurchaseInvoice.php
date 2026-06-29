<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\PurchaseInvoiceResource;

class CreatePurchaseInvoice extends CreateRecord
{
    protected static string $resource = PurchaseInvoiceResource::class;
}

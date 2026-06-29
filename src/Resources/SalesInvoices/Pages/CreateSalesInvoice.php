<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\SalesInvoiceResource;

class CreateSalesInvoice extends CreateRecord
{
    protected static string $resource = SalesInvoiceResource::class;
}

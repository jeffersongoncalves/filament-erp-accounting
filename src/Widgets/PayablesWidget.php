<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;

class PayablesWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $invoiceModel = ModelResolver::purchaseInvoice();

        $query = $invoiceModel::query()->where('docstatus', DocStatus::Submitted->value);

        $outstanding = (float) $query->sum('outstanding_amount');
        $count = (clone $query)->where('outstanding_amount', '>', 0)->count();

        return [
            Stat::make('Payables', number_format($outstanding, 2))
                ->description($count.' open purchase invoice(s)')
                ->color('danger'),
        ];
    }
}

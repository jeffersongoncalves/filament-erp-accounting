<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;

/**
 * The net debit balance of every Cash and Bank ledger account, computed from
 * the immutable general ledger (cancelled rows excluded).
 */
class CashBankBalanceWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $accountModel = ModelResolver::account();
        $glModel = ModelResolver::glEntry();

        $accountIds = $accountModel::query()
            ->whereIn('account_type', [AccountType::Bank->value, AccountType::Cash->value])
            ->pluck('id');

        $ledger = $glModel::query()
            ->whereIn('account_id', $accountIds)
            ->where('is_cancelled', false);

        $balance = (float) (clone $ledger)->sum('debit') - (float) (clone $ledger)->sum('credit');

        return [
            Stat::make('Cash & Bank Balance', number_format($balance, 2))
                ->description($accountIds->count().' cash/bank account(s)')
                ->color('primary'),
        ];
    }
}

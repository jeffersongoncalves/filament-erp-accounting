<div class="filament-hidden">

![Filament ERP Accounting](https://raw.githubusercontent.com/jeffersongoncalves/filament-erp-accounting/3.x/art/jeffersongoncalves-filament-erp-accounting.png)

</div>

# Filament ERP Accounting

Filament v5 panel resources for the [Laravel ERP accounting module](https://github.com/jeffersongoncalves/laravel-erp-accounting) — chart of accounts, journal/payment entries, invoices and the general ledger.

This package is the UI layer for the `jeffersongoncalves/laravel-erp-accounting` domain package (namespace `JeffersonGoncalves\Erp\Accounting\`). It wires the accounting models into Filament resources, with Submit/Cancel actions that drive the document lifecycle and post to the general ledger.

## Features

- **Master resources** — Chart of accounts, cost centers, payment terms, modes of payment, tax templates, banks and bank accounts
- **Transaction resources** — Journal entries, payment entries, sales invoices, purchase invoices and budgets, each with relation managers
- **Submit & Cancel actions** — Drive the domain document lifecycle (`submit()` / `cancel()`); any `DomainException` (such as an unbalanced journal entry) is surfaced as a danger notification
- **General ledger** — Read-only `GlEntryResource` viewer
- **Dashboard widgets** — Receivables, payables and cash/bank balance

## Compatibility

| Package | PHP | Filament | Laravel |
|---------|-----|----------|---------|
| `^3.0`  | `^8.2` | `^5.0` | `^11.0 \| ^12.0 \| ^13.0` |

## Installation

Install the package via Composer:

```bash
composer require jeffersongoncalves/filament-erp-accounting
```

Register the plugin on a Filament panel:

```php
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;

$panel->plugin(
    FilamentErpAccountingPlugin::make()
        ->navigationGroup('ERP — Accounting'),
);
```

## Resources

| Resource | Purpose |
|----------|---------|
| `AccountResource` | Chart of accounts (root/account type, tree via parent account) |
| `CostCenterResource` | Cost centers |
| `PaymentTermResource` | Payment terms |
| `ModeOfPaymentResource` | Modes of payment |
| `TaxTemplateResource` | Tax templates (+ Taxes relation manager) |
| `BankResource` | Banks |
| `BankAccountResource` | Bank accounts |
| `BudgetResource` | Budgets (+ Budget Accounts relation manager) |
| `JournalEntryResource` | Journal entries (+ Accounts RM, Submit/Cancel) |
| `PaymentEntryResource` | Payment entries (Submit/Cancel) |
| `SalesInvoiceResource` | Sales invoices (+ Items & Taxes RMs, Submit/Cancel) |
| `PurchaseInvoiceResource` | Purchase invoices (+ Items & Taxes RMs, Submit/Cancel) |
| `GlEntryResource` | Read-only general ledger viewer |

Transaction resources expose **Submit** and **Cancel** record actions that drive the domain document lifecycle (`$record->submit()` / `$record->cancel()`); any `DomainException` (such as an unbalanced journal entry) is surfaced as a danger notification.

## Widgets

| Widget | Purpose |
|--------|---------|
| `ReceivablesWidget` | Outstanding receivables |
| `PayablesWidget` | Outstanding payables |
| `CashBankBalanceWidget` | Aggregated cash and bank balance |

## Configuration

Publish the config to swap resource classes, change the navigation group, or adjust widgets:

```bash
php artisan vendor:publish --tag="filament-erp-accounting-config"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

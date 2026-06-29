<?php

use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\AccountResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\BankAccountResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Banks\BankResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\BudgetResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\CostCenterResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\GlEntryResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\JournalEntryResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\ModeOfPaymentResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\PaymentEntryResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\PaymentTermResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\PurchaseInvoiceResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\SalesInvoiceResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\TaxTemplateResource;
use JeffersonGoncalves\FilamentErp\Accounting\Widgets\CashBankBalanceWidget;
use JeffersonGoncalves\FilamentErp\Accounting\Widgets\PayablesWidget;
use JeffersonGoncalves\FilamentErp\Accounting\Widgets\ReceivablesWidget;

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group under which all ERP accounting resources are listed
    | in the Filament panel. Override per-plugin with ->navigationGroup('...').
    |
    */

    'navigation_group' => 'ERP — Accounting',

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The Filament resource classes registered by the plugin. Each entry can be
    | swapped for a custom resource extending the default one.
    |
    */

    'resources' => [
        'account' => AccountResource::class,
        'cost_center' => CostCenterResource::class,
        'payment_term' => PaymentTermResource::class,
        'mode_of_payment' => ModeOfPaymentResource::class,
        'tax_template' => TaxTemplateResource::class,
        'bank' => BankResource::class,
        'bank_account' => BankAccountResource::class,
        'budget' => BudgetResource::class,
        'journal_entry' => JournalEntryResource::class,
        'payment_entry' => PaymentEntryResource::class,
        'sales_invoice' => SalesInvoiceResource::class,
        'purchase_invoice' => PurchaseInvoiceResource::class,
        'gl_entry' => GlEntryResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | The Filament widgets registered by the plugin on the panel dashboard.
    |
    */

    'widgets' => [
        'receivables' => ReceivablesWidget::class,
        'payables' => PayablesWidget::class,
        'cash_bank_balance' => CashBankBalanceWidget::class,
    ],

];

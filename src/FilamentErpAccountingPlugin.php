<?php

namespace JeffersonGoncalves\FilamentErp\Accounting;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentErp\Accounting\Concerns\HasErpAccountingPluginConfig;
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

class FilamentErpAccountingPlugin implements Plugin
{
    use HasErpAccountingPluginConfig;

    public function getId(): string
    {
        return 'filament-erp-accounting';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resolveResources([
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
        ]));

        $panel->widgets($this->resolveWidgets());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

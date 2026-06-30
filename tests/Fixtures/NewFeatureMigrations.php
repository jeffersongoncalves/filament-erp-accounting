<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Tests\Fixtures;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\FilamentErp\Accounting\Tests\TestCase;

/**
 * Creates the database tables for the additive accounting features whose
 * migrations are not part of the base {@see TestCase}
 * migration set. Mirrors the vendored `*.php.stub` schema definitions. Each
 * create is guarded by {@see Schema::hasTable()} so it is safe to call from
 * every test's beforeEach regardless of the RefreshDatabase reset strategy.
 */
class NewFeatureMigrations
{
    public static function load(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        if (! Schema::hasTable($prefix.'tax_withholding_categories')) {
            Schema::create($prefix.'tax_withholding_categories', function (Blueprint $table) use ($prefix): void {
                $table->id();
                $table->string('name');
                $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($prefix.'tax_withholding_rates')) {
            Schema::create($prefix.'tax_withholding_rates', function (Blueprint $table) use ($prefix): void {
                $table->id();
                $table->foreignId('tax_withholding_category_id')->constrained($prefix.'tax_withholding_categories')->cascadeOnDelete();
                $table->date('from_date');
                $table->date('to_date')->nullable();
                $table->decimal('tax_rate', 5, 2);
                $table->decimal('single_threshold', 21, 9)->default(0);
                $table->decimal('cumulative_threshold', 21, 9)->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($prefix.'accounting_dimensions')) {
            Schema::create($prefix.'accounting_dimensions', function (Blueprint $table): void {
                $table->id();
                $table->string('label');
                $table->string('reference_document');
                $table->boolean('is_mandatory')->default(false);
                $table->boolean('disabled')->default(false);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($prefix.'accounting_dimension_values')) {
            Schema::create($prefix.'accounting_dimension_values', function (Blueprint $table) use ($prefix): void {
                $table->id();
                $table->foreignId('accounting_dimension_id')->constrained($prefix.'accounting_dimensions')->cascadeOnDelete();
                $table->string('value');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($prefix.'payment_reconciliations')) {
            Schema::create($prefix.'payment_reconciliations', function (Blueprint $table) use ($prefix): void {
                $table->id();
                $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
                $table->string('party_type')->default('Customer');
                $table->unsignedBigInteger('party_id')->nullable();
                $table->foreignId('receivable_payable_account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
                $table->unsignedTinyInteger('docstatus')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($prefix.'payment_reconciliation_allocations')) {
            Schema::create($prefix.'payment_reconciliation_allocations', function (Blueprint $table) use ($prefix): void {
                $table->id();
                $table->foreignId('payment_reconciliation_id')->constrained($prefix.'payment_reconciliations')->cascadeOnDelete();
                $table->foreignId('payment_entry_id')->constrained($prefix.'payment_entries')->cascadeOnDelete();
                $table->string('invoice_type');
                $table->unsignedBigInteger('invoice_id');
                $table->decimal('allocated_amount', 21, 9)->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($prefix.'dunnings')) {
            Schema::create($prefix.'dunnings', function (Blueprint $table) use ($prefix): void {
                $table->id();
                $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
                $table->string('party_type')->default('Customer');
                $table->unsignedBigInteger('party_id')->nullable();
                $table->string('customer_name')->nullable();
                $table->date('posting_date');
                $table->integer('dunning_level')->default(1);
                $table->decimal('rate_of_interest', 5, 2)->default(0);
                $table->decimal('total_interest', 21, 9)->default(0);
                $table->decimal('dunning_amount', 21, 9)->default(0);
                $table->foreignId('income_account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
                $table->foreignId('debit_to_account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
                $table->unsignedTinyInteger('docstatus')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($prefix.'dunning_overdue_invoices')) {
            Schema::create($prefix.'dunning_overdue_invoices', function (Blueprint $table) use ($prefix): void {
                $table->id();
                $table->foreignId('dunning_id')->constrained($prefix.'dunnings')->cascadeOnDelete();
                $table->foreignId('sales_invoice_id')->constrained($prefix.'sales_invoices')->cascadeOnDelete();
                $table->integer('overdue_days')->default(0);
                $table->decimal('outstanding', 21, 9)->default(0);
                $table->decimal('interest', 21, 9)->default(0);
                $table->timestamps();
            });
        }
    }
}

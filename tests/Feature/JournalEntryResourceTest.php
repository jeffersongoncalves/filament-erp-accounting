<?php

use Filament\Actions\Testing\TestAction;
use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Accounting\Models\GlEntry;
use JeffersonGoncalves\Erp\Accounting\Models\JournalEntry;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages\CreateJournalEntry;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages\EditJournalEntry;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages\ListJournalEntries;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
    $this->debit = Account::factory()->create(['company_id' => $this->company->id]);
    $this->credit = Account::factory()->create(['company_id' => $this->company->id]);
});

function makeJournalEntry(float $debit, float $credit): JournalEntry
{
    $entry = JournalEntry::factory()->create(['company_id' => test()->company->id]);
    $entry->accounts()->create(['account_id' => test()->debit->id, 'debit' => $debit, 'credit' => 0]);
    $entry->accounts()->create(['account_id' => test()->credit->id, 'debit' => 0, 'credit' => $credit]);

    return $entry->refresh();
}

it('can render the journal entry list page', function () {
    Livewire::test(ListJournalEntries::class)->assertSuccessful();
});

it('can render the journal entry create page', function () {
    Livewire::test(CreateJournalEntry::class)->assertSuccessful();
});

it('can render the journal entry edit page', function () {
    $entry = makeJournalEntry(100, 100);

    Livewire::test(EditJournalEntry::class, ['record' => $entry->getRouteKey()])
        ->assertSuccessful();
});

it('submits a balanced journal entry through the table action and posts the ledger', function () {
    $entry = makeJournalEntry(100, 100);

    Livewire::test(ListJournalEntries::class)
        ->callAction(TestAction::make('submit')->table($entry));

    expect($entry->refresh()->docstatus)->toBe(DocStatus::Submitted)
        ->and(GlEntry::query()->count())->toBe(2)
        ->and((float) GlEntry::query()->sum('debit'))->toBe(100.0)
        ->and((float) GlEntry::query()->sum('credit'))->toBe(100.0);
});

it('does not post the ledger when submitting an unbalanced journal entry', function () {
    $entry = makeJournalEntry(100, 60);

    Livewire::test(ListJournalEntries::class)
        ->callAction(TestAction::make('submit')->table($entry))
        ->assertNotified();

    expect(GlEntry::query()->count())->toBe(0);
});

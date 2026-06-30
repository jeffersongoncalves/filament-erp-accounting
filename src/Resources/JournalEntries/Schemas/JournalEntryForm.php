<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use JeffersonGoncalves\Erp\Accounting\Enums\JournalEntryType;

class JournalEntryForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        DatePicker::make('posting_date')
                            ->label('Posting Date')
                            ->required()
                            ->default(now()),
                        Select::make('voucher_type')
                            ->label('Voucher Type')
                            ->options(self::voucherTypeOptions())
                            ->default(JournalEntryType::JournalEntry->value)
                            ->required(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Textarea::make('user_remark')
                            ->label('User Remark')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    /** @return array<string, string> */
    protected static function voucherTypeOptions(): array
    {
        $options = [];

        foreach (JournalEntryType::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}

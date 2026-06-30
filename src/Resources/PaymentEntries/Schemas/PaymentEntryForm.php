<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use JeffersonGoncalves\Erp\Accounting\Enums\PaymentType;

class PaymentEntryForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        Select::make('payment_type')
                            ->label('Payment Type')
                            ->options(self::paymentTypeOptions())
                            ->required(),
                        DatePicker::make('posting_date')
                            ->label('Posting Date')
                            ->required()
                            ->default(now()),
                        TextInput::make('party_type')
                            ->label('Party Type')
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Party ID')
                            ->numeric(),
                        TextInput::make('party_name')
                            ->label('Party Name')
                            ->maxLength(255),
                        Select::make('mode_of_payment_id')
                            ->label('Mode of Payment')
                            ->relationship('modeOfPayment', 'name')
                            ->searchable()
                            ->nullable(),
                        Select::make('paid_from_id')
                            ->label('Paid From')
                            ->relationship('paidFrom', 'name')
                            ->searchable()
                            ->required(),
                        Select::make('paid_to_id')
                            ->label('Paid To')
                            ->relationship('paidTo', 'name')
                            ->searchable()
                            ->required(),
                        TextInput::make('paid_amount')
                            ->label('Paid Amount')
                            ->numeric()
                            ->default(0),
                        TextInput::make('received_amount')
                            ->label('Received Amount')
                            ->numeric()
                            ->default(0),
                        TextInput::make('reference_no')
                            ->label('Reference No')
                            ->maxLength(255),
                        DatePicker::make('reference_date')
                            ->label('Reference Date'),
                    ])->columns(2),
            ]);
    }

    /** @return array<string, string> */
    protected static function paymentTypeOptions(): array
    {
        $options = [];

        foreach (PaymentType::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}

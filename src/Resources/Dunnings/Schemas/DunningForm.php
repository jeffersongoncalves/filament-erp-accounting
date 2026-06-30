<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class DunningForm
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
                        TextInput::make('customer_name')
                            ->label('Customer Name')
                            ->maxLength(255),
                        TextInput::make('party_type')
                            ->label('Party Type')
                            ->required()
                            ->default('Customer')
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Party ID')
                            ->numeric()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('dunning_level')
                            ->label('Dunning Level')
                            ->integer()
                            ->default(1),
                    ])->columns(2),
                Section::make('Interest')
                    ->schema([
                        TextInput::make('rate_of_interest')
                            ->label('Rate of Interest')
                            ->numeric()
                            ->default(0),
                        TextInput::make('total_interest')
                            ->label('Total Interest')
                            ->numeric()
                            ->default(0),
                        TextInput::make('dunning_amount')
                            ->label('Dunning Amount')
                            ->numeric()
                            ->default(0),
                        Select::make('income_account_id')
                            ->label('Income Account')
                            ->relationship('incomeAccount', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('debit_to_account_id')
                            ->label('Debit To Account')
                            ->relationship('debitToAccount', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columns(2),
            ]);
    }
}

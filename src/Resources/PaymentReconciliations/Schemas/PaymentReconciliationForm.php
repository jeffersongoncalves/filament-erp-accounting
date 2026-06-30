<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentReconciliationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('party_type')
                            ->label('Party Type')
                            ->required()
                            ->default('Customer')
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Party ID')
                            ->numeric()
                            ->nullable(),
                        Select::make('receivable_payable_account_id')
                            ->label('Receivable / Payable Account')
                            ->relationship('receivablePayableAccount', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}

<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BankAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('account_name')
                            ->label('Account Name')
                            ->required()
                            ->maxLength(255),
                        Select::make('bank_id')
                            ->label('Bank')
                            ->relationship('bank', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('account_no')
                            ->label('Account No')
                            ->nullable()
                            ->maxLength(255),
                        Select::make('account_id')
                            ->label('Ledger Account')
                            ->relationship('account', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Toggle::make('is_default')
                            ->label('Is Default')
                            ->default(false),
                        Toggle::make('is_company_account')
                            ->label('Is Company Account')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}

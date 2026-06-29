<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PurchaseInvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('supplier_name')
                            ->label('Supplier Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Party ID')
                            ->numeric()
                            ->nullable(),
                        DatePicker::make('posting_date')
                            ->label('Posting Date')
                            ->required()
                            ->default(now()),
                        DatePicker::make('due_date')
                            ->label('Due Date')
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('credit_to_id')
                            ->label('Credit To (Payable)')
                            ->relationship('creditTo', 'name')
                            ->searchable()
                            ->required(),
                        TextInput::make('currency')
                            ->default('USD')
                            ->maxLength(3),
                    ])->columns(2),
            ]);
    }
}

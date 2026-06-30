<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AllocationsRelationManager extends RelationManager
{
    protected static string $relationship = 'allocations';

    protected static ?string $title = 'Allocations';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Select::make('payment_entry_id')
                    ->label('Payment Entry')
                    ->relationship('paymentEntry', 'party_name')
                    ->searchable()
                    ->required(),
                TextInput::make('invoice_type')
                    ->label('Invoice Type')
                    ->required()
                    ->default('SalesInvoice')
                    ->maxLength(255),
                TextInput::make('invoice_id')
                    ->label('Invoice ID')
                    ->numeric()
                    ->required(),
                TextInput::make('allocated_amount')
                    ->label('Allocated Amount')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('invoice_type')
            ->columns([
                TextColumn::make('paymentEntry.party_name')
                    ->label('Payment Entry')
                    ->searchable(),
                TextColumn::make('invoice_type')
                    ->label('Invoice Type'),
                TextColumn::make('invoice_id')
                    ->label('Invoice ID'),
                TextColumn::make('allocated_amount')
                    ->label('Allocated Amount')
                    ->numeric(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

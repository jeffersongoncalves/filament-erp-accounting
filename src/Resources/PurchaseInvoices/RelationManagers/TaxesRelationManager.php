<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaxesRelationManager extends RelationManager
{
    protected static string $relationship = 'taxes';

    protected static ?string $title = 'Taxes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('account_id')
                    ->label('Account')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('rate')
                    ->label('Rate (%)')
                    ->numeric()
                    ->default(0),
                TextInput::make('tax_amount')
                    ->label('Tax Amount')
                    ->numeric()
                    ->default(0),
                TextInput::make('description')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('account_id')
            ->columns([
                TextColumn::make('account.name')
                    ->label('Account'),
                TextColumn::make('rate')
                    ->numeric(),
                TextColumn::make('tax_amount')
                    ->numeric(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Items';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                TextInput::make('item_code')
                    ->label('Item Code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('item_name')
                    ->label('Item Name')
                    ->maxLength(255),
                TextInput::make('qty')
                    ->numeric()
                    ->default(1),
                TextInput::make('rate')
                    ->numeric()
                    ->default(0),
                TextInput::make('amount')
                    ->label('Amount')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),
                Select::make('expense_account_id')
                    ->label('Expense Account')
                    ->relationship('expenseAccount', 'name')
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('item_code')
            ->columns([
                TextColumn::make('item_code')
                    ->label('Item Code')
                    ->searchable(),
                TextColumn::make('item_name')
                    ->label('Item Name'),
                TextColumn::make('qty')
                    ->numeric(),
                TextColumn::make('rate')
                    ->numeric(),
                TextColumn::make('amount')
                    ->numeric(),
                TextColumn::make('expenseAccount.name')
                    ->label('Expense Account')
                    ->toggleable(),
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

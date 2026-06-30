<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OverdueInvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'overdueInvoices';

    protected static ?string $title = 'Overdue Invoices';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Select::make('sales_invoice_id')
                    ->label('Sales Invoice')
                    ->relationship('salesInvoice', 'customer_name')
                    ->searchable()
                    ->required(),
                TextInput::make('overdue_days')
                    ->label('Overdue Days')
                    ->integer()
                    ->default(0),
                TextInput::make('outstanding')
                    ->numeric()
                    ->default(0),
                TextInput::make('interest')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sales_invoice_id')
            ->columns([
                TextColumn::make('salesInvoice.customer_name')
                    ->label('Sales Invoice')
                    ->searchable(),
                TextColumn::make('overdue_days')
                    ->label('Overdue Days')
                    ->numeric(),
                TextColumn::make('outstanding')
                    ->numeric(),
                TextColumn::make('interest')
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

<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaxWithholdingCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('rates_count')
                    ->label('Rates')
                    ->counts('rates')
                    ->toggleable(),
            ])
            ->defaultSort('name')
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

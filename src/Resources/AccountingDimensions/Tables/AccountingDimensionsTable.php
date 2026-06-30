<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AccountingDimensionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reference_document')
                    ->label('Reference Document')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_mandatory')
                    ->label('Mandatory')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('disabled')
                    ->label('Disabled')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('label')
            ->filters([
                TernaryFilter::make('is_mandatory')
                    ->label('Is Mandatory'),
                TernaryFilter::make('disabled')
                    ->label('Disabled'),
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

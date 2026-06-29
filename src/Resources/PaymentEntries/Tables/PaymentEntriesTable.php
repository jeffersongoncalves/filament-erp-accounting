<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\FilamentErp\Core\Concerns\SubmittableRecordActions;

class PaymentEntriesTable
{
    use SubmittableRecordActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('posting_date')
                    ->label('Posting Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('payment_type')
                    ->label('Payment Type')
                    ->badge(),
                TextColumn::make('party_name')
                    ->label('Party Name')
                    ->searchable(),
                TextColumn::make('paidFrom.name')
                    ->label('Paid From')
                    ->toggleable(),
                TextColumn::make('paidTo.name')
                    ->label('Paid To')
                    ->toggleable(),
                TextColumn::make('paid_amount')
                    ->label('Paid Amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('docstatus')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof DocStatus ? $state->name : $state)
                    ->color(fn ($state) => match ($state) {
                        DocStatus::Draft => 'gray',
                        DocStatus::Submitted => 'success',
                        DocStatus::Cancelled => 'danger',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('posting_date', 'desc')
            ->filters([
                SelectFilter::make('docstatus')
                    ->label('Status')
                    ->options([
                        0 => 'Draft',
                        1 => 'Submitted',
                        2 => 'Cancelled',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
                ...self::submittableRecordActions(),
                Actions\DeleteAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
            ]);
    }
}

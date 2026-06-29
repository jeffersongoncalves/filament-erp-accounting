<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('account_number')
                            ->label('Account Number')
                            ->maxLength(255),
                        Select::make('parent_account_id')
                            ->label('Parent Account')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('root_type')
                            ->label('Root Type')
                            ->options(self::rootTypeOptions()),
                        Select::make('account_type')
                            ->label('Account Type')
                            ->options(self::accountTypeOptions())
                            ->searchable(),
                        TextInput::make('account_currency')
                            ->label('Account Currency')
                            ->maxLength(3),
                        Toggle::make('is_group')
                            ->label('Is Group')
                            ->default(false),
                        Toggle::make('disabled')
                            ->label('Disabled')
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    /** @return array<string, string> */
    protected static function rootTypeOptions(): array
    {
        $options = [];

        foreach (RootType::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }

    /** @return array<string, string> */
    protected static function accountTypeOptions(): array
    {
        $options = [];

        foreach (AccountType::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}

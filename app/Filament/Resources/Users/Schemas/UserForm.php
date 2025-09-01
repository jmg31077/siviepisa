<?php

namespace App\Filament\Resources\Users\Schemas;

// use Filament\Forms\Components\DateTimePicker;

use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Enums\Operation;
use Illuminate\Support\Collection;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal info')
                // ->columns(4)
                    ->schema([

                    TextInput::make('name')
                    ->required(),
                    TextInput::make('email')
                    ->email()
                    ->required(),
                // DateTimePicker::make('email_verified_at'),
                    TextInput::make('password')
                        ->password()

                        ->hiddenOn(Operation::Edit)
                        ->required(),

                    ]),
                Section::make('Address info')
                // ->columns(4)
                    ->schema([

                    Select::make('country_id')
                        ->relationship(name: 'country',titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(function (Set $set) {
                            $set('state_id',null);
                            $set('city_id',null);
                        })

                        ->required(),
                    Select::make('state_id')
                        ->options(fn (Get $get): Collection => State::query()
                        ->where('country_id', $get('country_id'))
                        ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(fn (Set $set) => $set('city_id',null))
                        ->required(),
                    Select::make('city_id')
                        ->options(fn (Get $get): Collection => City::query()
                        ->where('state_id', $get('state_id'))
                        ->pluck('name', 'id'))

                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),
                        TextInput::make('address')
                        ->required(),
                        TextInput::make('postal_code')
                        ->required(),


            ])
                    ]);
    }
}

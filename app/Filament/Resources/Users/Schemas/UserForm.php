<?php

namespace App\Filament\Resources\Users\Schemas;

// use Filament\Forms\Components\DateTimePicker;

use App\Models\State;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
// use Filament\Notifications\Collection;
// use Filament\Forms\Get;
// use Filament\Forms\Form;
// use Filament\Table;
// use Filament\Resources\Resource;
use Illuminate\Support\Collection;

use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal info')
                ->columns(3)
                    ->schema([

                    TextInput::make('name')
                       ->required(),
                    TextInput::make('email')
                       ->label('Email address')
                       ->email()
                       ->required(),
                // DateTimePicker::make('email_verified_at'),
                    TextInput::make('password')
                        ->password()
                        ->required(),
                    ]),
                Section::make('Address info')
                ->columns(3)
                    ->schema([

                    Select::make('country_id')
                        ->relationship(name: 'country',titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),
                    Select::make('state_id')
                        ->options(fn (Get $get): Collection => State::query()
                        ->where('country_id', $get('country_id'))
                        ->pluck('name', 'id'))

                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),
                    Select::make('city_id')

                        ->relationship(name: 'city', titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),

            ])
                    ]);
    }
}

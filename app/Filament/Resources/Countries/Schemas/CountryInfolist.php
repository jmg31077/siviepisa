<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CountryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('iso2'),
                TextEntry::make('iso3'),
                TextEntry::make('numeric_code'),
                TextEntry::make('phonecode'),
                TextEntry::make('capital'),
                TextEntry::make('currency'),
                TextEntry::make('currency_name'),
                TextEntry::make('currency_symbol'),
                TextEntry::make('tld'),
                TextEntry::make('native'),
                TextEntry::make('region'),
                TextEntry::make('subregion'),
                TextEntry::make('latitude')
                    ->numeric(),
                TextEntry::make('longitude')
                    ->numeric(),
                TextEntry::make('emoji'),
                TextEntry::make('emojiU'),
                IconEntry::make('flag')
                    ->boolean(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}

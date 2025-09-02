<?php

namespace App\Filament\Resources\Kitchens\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KitchenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('year')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->required()
                    ->disk('public')
                    ->image(),
            ]);
    }
}

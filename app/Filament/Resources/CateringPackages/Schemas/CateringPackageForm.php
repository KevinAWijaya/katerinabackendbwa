<?php

namespace App\Filament\Resources\CateringPackages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class CateringPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Fieldset::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('thumbnail')
                            ->required()
                            ->disk('public')
                            ->image(),

                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->required()
                                    ->disk('public')
                                    ->image(),
                            ]),
                    ]),

                Fieldset::make('Additional')
                    ->schema([
                        Textarea::make('about')
                            ->required()
                            ->maxLength(255),

                        Select::make('is_popular')
                            ->required()
                            ->options([
                                true => 'Popular',
                                false => 'Not Popular'
                            ]),

                        Select::make('city_id')
                            ->required()
                            ->relationship('city', 'name')
                            ->preload()
                            ->searchable(),

                        Select::make('kitchen_id')
                            ->required()
                            ->relationship('kitchen', 'name')
                            ->preload()
                            ->searchable(),

                        Select::make('category_id')
                            ->required()
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable(),

                    ])
            ]);
    }
}

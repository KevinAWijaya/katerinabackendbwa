<?php

namespace App\Filament\Resources\CateringTestimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CateringTestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->required()
                    ->disk('public')
                    ->image(),

                Select::make('catering_package_id')
                    ->required()
                    ->relationship('cateringPackage', 'name')
                    ->preload()
                    ->searchable(),

                Textarea::make('message')
                    ->required(),

            ]);
    }
}

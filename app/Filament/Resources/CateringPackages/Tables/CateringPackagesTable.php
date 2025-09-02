<?php

namespace App\Filament\Resources\CateringPackages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CateringPackagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('thumbnail')
                    ->disk('public'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('kitchen.name'),

                IconColumn::make('is_popular')
                    ->boolean()
                    ->label('Popular')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name'),

                SelectFilter::make('kitchen_id')
                    ->label('Kitchen')
                    ->relationship('kitchen', 'name'),

                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),

                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

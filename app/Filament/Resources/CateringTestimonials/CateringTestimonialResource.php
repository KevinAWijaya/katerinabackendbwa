<?php

namespace App\Filament\Resources\CateringTestimonials;

use App\Filament\Resources\CateringTestimonials\Pages\CreateCateringTestimonial;
use App\Filament\Resources\CateringTestimonials\Pages\EditCateringTestimonial;
use App\Filament\Resources\CateringTestimonials\Pages\ListCateringTestimonials;
use App\Filament\Resources\CateringTestimonials\Schemas\CateringTestimonialForm;
use App\Filament\Resources\CateringTestimonials\Tables\CateringTestimonialsTable;
use App\Models\CateringTestimonial;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CateringTestimonialResource extends Resource
{
    protected static ?string $model = CateringTestimonial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;

    protected static string| \UnitEnum | null $navigationGroup = 'Customer';

    public static function form(Schema $schema): Schema
    {
        return CateringTestimonialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CateringTestimonialsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCateringTestimonials::route('/'),
            'create' => CreateCateringTestimonial::route('/create'),
            'edit' => EditCateringTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

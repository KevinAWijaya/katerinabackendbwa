<?php

namespace App\Filament\Resources\CateringSubscriptions;

use App\Filament\Resources\CateringSubscriptions\Pages\CreateCateringSubscription;
use App\Filament\Resources\CateringSubscriptions\Pages\EditCateringSubscription;
use App\Filament\Resources\CateringSubscriptions\Pages\ListCateringSubscriptions;
use App\Filament\Resources\CateringSubscriptions\Schemas\CateringSubscriptionForm;
use App\Filament\Resources\CateringSubscriptions\Tables\CateringSubscriptionsTable;
use App\Models\CateringSubscription;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CateringSubscriptionResource extends Resource
{
    protected static ?string $model = CateringSubscription::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static string| \UnitEnum | null $navigationGroup = 'Transaction';

    public static function getNavigationBadge(): ?string
    {
        return (string) CateringSubscription::where('is_paid', false)->count();
    }

    public static function form(Schema $schema): Schema
    {
        return CateringSubscriptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CateringSubscriptionsTable::configure($table);
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
            'index' => ListCateringSubscriptions::route('/'),
            'create' => CreateCateringSubscription::route('/create'),
            'edit' => EditCateringSubscription::route('/{record}/edit'),
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

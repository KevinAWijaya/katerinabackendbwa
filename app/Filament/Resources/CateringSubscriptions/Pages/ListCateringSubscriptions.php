<?php

namespace App\Filament\Resources\CateringSubscriptions\Pages;

use App\Filament\Resources\CateringSubscriptions\CateringSubscriptionResource;
use App\Filament\Resources\CateringSubscriptions\Widgets\CateringSubscriptionStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCateringSubscriptions extends ListRecords
{
    protected static string $resource = CateringSubscriptionResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CateringSubscriptionStats::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

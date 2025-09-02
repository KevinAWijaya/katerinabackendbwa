<?php

namespace App\Filament\Resources\CateringSubscriptions\Pages;

use App\Filament\Resources\CateringSubscriptions\CateringSubscriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCateringSubscription extends EditRecord
{
    protected static string $resource = CateringSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}

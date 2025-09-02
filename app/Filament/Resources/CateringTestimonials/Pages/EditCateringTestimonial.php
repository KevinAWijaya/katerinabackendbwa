<?php

namespace App\Filament\Resources\CateringTestimonials\Pages;

use App\Filament\Resources\CateringTestimonials\CateringTestimonialResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCateringTestimonial extends EditRecord
{
    protected static string $resource = CateringTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}

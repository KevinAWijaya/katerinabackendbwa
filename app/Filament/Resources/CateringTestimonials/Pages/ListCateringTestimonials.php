<?php

namespace App\Filament\Resources\CateringTestimonials\Pages;

use App\Filament\Resources\CateringTestimonials\CateringTestimonialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCateringTestimonials extends ListRecords
{
    protected static string $resource = CateringTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\GroomingBookingResource\Pages;

use App\Filament\Resources\GroomingBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroomingBookings extends ListRecords
{
    protected static string $resource = GroomingBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

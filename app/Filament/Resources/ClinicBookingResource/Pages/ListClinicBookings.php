<?php

namespace App\Filament\Resources\ClinicBookingResource\Pages;

use App\Filament\Resources\ClinicBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClinicBookings extends ListRecords
{
    protected static string $resource = ClinicBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

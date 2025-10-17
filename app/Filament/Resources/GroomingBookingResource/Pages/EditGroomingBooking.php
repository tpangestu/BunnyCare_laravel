<?php

namespace App\Filament\Resources\GroomingBookingResource\Pages;

use App\Filament\Resources\GroomingBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGroomingBooking extends EditRecord
{
    protected static string $resource = GroomingBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

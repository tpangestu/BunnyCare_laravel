<?php

namespace App\Filament\Resources\GroomingBookingResource\Pages;

use App\Filament\Resources\GroomingBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist; // Pastikan ini ada

class ViewGroomingBooking extends ViewRecord
{
    protected static string $resource = GroomingBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->record)
            ->schema([
                TextEntry::make('name')->label('Nama Pemesan'),
                TextEntry::make('phone_number')->label('Nomor HP'),
                TextEntry::make('booking_date')->label('Tanggal Booking')->date(),
                ImageEntry::make('proof_of_payment')
                    ->label('Bukti Pembayaran')
                    ->disk('public')
                    ->height(150),
                TextEntry::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'confirmed' => 'success',
                        'rejected' => 'danger',
                    }),
            ]);
    }
}
<?php

namespace App\Filament\Resources\ClinicBookingResource\Pages;

use App\Filament\Resources\ClinicBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

// Pastikan semua ini diimport dengan benar:
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class ViewClinicBooking extends ViewRecord
{
    protected static string $resource = ClinicBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('confirm')
                ->label('Confirm')
                ->color('success')
                ->icon('heroicon-o-check')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'pending')
                ->action(function () {
                    $this->record->status = 'confirmed';
                    $this->record->save();
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            Actions\Action::make('reject')
                ->label('Reject')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'pending')
                ->action(function () {
                    $this->record->status = 'rejected';
                    $this->record->save();
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
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
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClinicBookingResource\Pages;
use App\Filament\Resources\ClinicBookingResource\RelationManagers;
use App\Models\ClinicBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClinicBookingResource extends Resource
{
    protected static ?string $model = ClinicBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Data Pemesanan';
    protected static ?string $pluralModelLabel = 'Data Klinik'; // Label di sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('phone_number')->required()->maxLength(255),
                Forms\Components\DatePicker::make('booking_date')->required(),
                Forms\Components\FileUpload::make('proof_of_payment')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->directory('proofs')
                    ->visibility('public')
                    ->disk('public') // Tambahkan ini!
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Booking ID Clinic')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'C' . str_pad($state, 3, '0', STR_PAD_LEFT)),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('booking_date')->date(),
                Tables\Columns\ImageColumn::make('proof_of_payment')
                    ->label('Bukti Pembayaran')
                    ->disk('public') // Tambahkan ini!
                    ->height(80) // Atur tinggi agar terlihat jelas
                    ->square(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'confirmed' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('confirm')
                    ->label('Confirm')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->status = 'confirmed';
                        $record->save();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->status = 'rejected';
                        $record->save();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListClinicBookings::route('/'),
            'create' => Pages\CreateClinicBooking::route('/create'),
            'edit' => Pages\EditClinicBooking::route('/{record}/edit'),
            'view' => Pages\ViewClinicBooking::route('/{record}'),
        ];
    }
}
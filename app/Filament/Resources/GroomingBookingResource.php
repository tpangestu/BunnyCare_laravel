<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroomingBookingResource\Pages;
use App\Filament\Resources\GroomingBookingResource\RelationManagers;
use App\Models\GroomingBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use Filament\Tables\Columns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroomingBookingResource extends Resource
{
    protected static ?string $model = GroomingBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Data Pemesanan';
    protected static ?string $pluralModelLabel = 'Data Grooming'; // Label di sidebar

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
                    ->disk('public')
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
                Columns\TextColumn::make('id')
                    ->label('Booking ID Grooming')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'G' . str_pad($state, 3, '0', STR_PAD_LEFT)),
                Columns\TextColumn::make('name')->searchable(),
                Columns\TextColumn::make('phone_number'),
                Columns\TextColumn::make('booking_date')->date(),
                Columns\ImageColumn::make('proof_of_payment')
                    ->label('Bukti Pembayaran')
                    ->disk('public') // Tambahkan ini!
                    ->height(80) // Atur tinggi agar terlihat jelas
                    ->square(), // Opsional: tampilkan sebagai kotak
                Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'confirmed' => 'success',
                        'rejected' => 'danger',
                    }),
                Columns\TextColumn::make('created_at')
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
                Actions\Action::make('confirm')
                    ->label('Confirm')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->status = 'confirmed';
                        $record->save();
                    }),
                Actions\Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->status = 'rejected';
                        $record->save();
                    }),

                Actions\ViewAction::make(), // Untuk melihat detail
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListGroomingBookings::route('/'),
            'create' => Pages\CreateGroomingBooking::route('/create'),
            'edit' => Pages\EditGroomingBooking::route('/{record}/edit'),
            'view' => Pages\ViewGroomingBooking::route('/{record}'), // Tambahkan ini
        ];
    }
}

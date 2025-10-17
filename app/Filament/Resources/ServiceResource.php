<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase'; // Icon untuk menu

    protected static ?string $navigationGroup = 'Manajemen Layanan'; // Kelompok menu

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type') // Ini untuk memilih tipe layanan
                    ->options([
                        'grooming' => 'Grooming',
                        'clinic' => 'Bunny Clinic',
                        'hotel' => 'Bunny Hotel',
                    ])
                    ->required()
                    ->native(false), // Opsional: untuk styling select yang lebih baik
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->directory('uploads')
                    ->preserveFilenames()
                    ->maxSize(1024)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('public')
                    ->nullable(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->nullable(), // Bisa null untuk hotel
                Forms\Components\Textarea::make('description')
                    ->nullable()
                    ->rows(5)
                    ->cols(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe Layanan')
                    ->badge() // Tampilkan sebagai badge
                    ->color(fn (string $state): string => match ($state) {
                        'grooming' => 'info', // Warna biru muda
                        'clinic' => 'warning', // Warna kuning
                        'hotel' => 'success', // Warna hijau
                    })
                    ->searchable(),
                Tables\Columns\ImageColumn::make('photo')
                    ->disk('public') // Pastikan disk yang digunakan adalah public
                    ->square() // Tampilkan gambar kotak
                    ->height(50),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR') // Format sebagai mata uang IDR
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyikan default
                Tables\Columns\TextColumn::make('description')
                    ->limit(50) // Batasi teks deskripsi
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type') // Filter berdasarkan tipe layanan
                    ->options([
                        'grooming' => 'Grooming',
                        'clinic' => 'Bunny Clinic',
                        'hotel' => 'Bunny Hotel',
                    ])
            ])
            ->actions([
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
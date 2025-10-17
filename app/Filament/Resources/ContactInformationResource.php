<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInformationResource\Pages;
use App\Filament\Resources\ContactInformationResource\RelationManagers;
use App\Models\ContactInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactInformationResource extends Resource
{
    protected static ?string $model = ContactInformation::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $pluralModelLabel = 'Informasi Kontak'; // Label di sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('instagram')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->nullable()
                    ->rows(3)
                    ->cols(10),
                Forms\Components\Textarea::make('map_embed_code')
                    ->label('Kode Embed Peta Google Maps')
                    ->nullable()
                    ->rows(5)
                    ->cols(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('instagram'),
                Tables\Columns\TextColumn::make('address')->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Mungkin kamu hanya ingin 1 data untuk info kontak, jadi batasi Create/Delete
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListContactInformation::route('/'),
            'create' => Pages\CreateContactInformation::route('/create'),
            'edit' => Pages\EditContactInformation::route('/{record}/edit'),
        ];
    }
    // Jika kamu ingin membatasi hanya satu entri informasi kontak, tambahkan ini:
    public static function canCreate(): bool
    {
        return ContactInformation::count() === 0;
    }
}
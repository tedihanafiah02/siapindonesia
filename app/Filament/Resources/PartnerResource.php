<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Our Client';

    protected static ?string $modelLabel = 'Our Client';

    protected static ?string $pluralModelLabel = 'Our Client';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->label('Nama Client'),
            Forms\Components\FileUpload::make('logo_path')
                ->required()
                ->label('Logo Client')
                ->directory('partners') // Simpan logo di folder 'storage/app/public/partners'
                ->image(),
            Forms\Components\TextInput::make('alt_text')->label('Teks Alternatif')->nullable(),
            Forms\Components\Select::make('row_position')
                ->options([
                    1 => 'Baris 1 (Kiri ke Kanan)',
                    2 => 'Baris 2 (Kanan ke Kiri)',
                ])
                ->default(1)
                ->required()
                ->label('Posisi Baris'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')->label('Logo')->disk('public'), // Sesuaikan dengan disk yang digunakan
                Tables\Columns\TextColumn::make('name')->label('Nama Client')->searchable(),
                Tables\Columns\TextColumn::make('alt_text')->label('Teks Alternatif'),
                Tables\Columns\TextColumn::make('row_position')
                    ->label('Posisi Baris')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'warning',
                        '2' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (int $state): string => "Baris {$state}"),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
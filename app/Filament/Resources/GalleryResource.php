<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('image_path')
                ->label('Image')
                ->required()
                ->directory('gallery-images') // Folder penyimpanan gambar
                ->image() // Hanya menerima file gambar
                ->maxSize(5048) // Batas ukuran file (2MB)
                ->disk('public'), // Gunakan disk 'public'
            Forms\Components\TextInput::make('alt_text')->label('Alt Text')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([Tables\Columns\ImageColumn::make('image_path')->label('Image'), Tables\Columns\TextColumn::make('alt_text')->label('Alt Text')])
            ->filters([
                //
            ])

            ->actions([
                Tables\Actions\EditAction::make(), // Tombol Edit
                Tables\Actions\DeleteAction::make(), // Tombol Delete
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Tombol Delete untuk multiple records
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
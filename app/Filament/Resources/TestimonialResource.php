<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Testimoni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->maxLength(255)
                    ->helperText('Opsional (Contoh: Menteri Investasi)'),

                Forms\Components\FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->directory('testimonials')
                    ->visibility('public')
                    ->helperText('Wajib untuk testimoni tertulis (sebagai avatar), opsional jika mengisi Link Video YouTube'),

                Forms\Components\Textarea::make('message')
                    ->label('Pesan Testimoni')
                    ->rows(5)
                    ->required(),

                Forms\Components\Select::make('row')
                    ->label('Baris Tampilan')
                    ->options([
                        1 => 'Baris 1 (Slide Kiri ke Kanan)',
                        2 => 'Baris 2 (Slide Kanan ke Kiri)',
                    ])
                    ->default(1)
                    ->helperText('Hanya berpengaruh pada tampilan slide testimoni tertulis'),

                Forms\Components\TextInput::make('video_url')
                    ->label('Link Video YouTube')
                    ->helperText('Contoh: https://www.youtube.com/watch?v=xxxx atau https://youtu.be/xxxx (Biarkan kosong jika testimoni tertulis biasa)')
                    ->url()
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->width(60)
                    ->height(60),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan'),

                Tables\Columns\TextColumn::make('row')
                    ->label('Baris Tampilan')
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        1 => 'info',
                        2 => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (int $state): string => "Baris $state")
                    ->sortable(),

                Tables\Columns\TextColumn::make('video_url')
                    ->label('Video')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn (?string $state): string => $state ? 'Ada Video' : 'Teks Saja'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50),
            ])
            ->filters([
                //
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}

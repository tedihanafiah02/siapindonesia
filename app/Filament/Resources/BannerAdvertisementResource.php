<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerAdvertisementResource\Pages;
use App\Filament\Resources\BannerAdvertisementResource\RelationManagers;
use App\Models\BannerAdvertisement;
use Dotenv\Util\Str;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerAdvertisementResource extends Resource
{
    protected static ?string $model = BannerAdvertisement::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    public static function getModelLabel(): string
    {
        return 'Banner Iklan';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Banner Iklan';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Banner')
                ->schema([
                    Forms\Components\TextInput::make('link')
                        ->activeUrl()
                        ->required()
                        ->maxLength(255)
                        ->label('Link URL'),

                    Forms\Components\Select::make('type')
                        ->options([
                            'banner' => 'Banner',
                            'square' => 'Square',
                        ])
                        ->required()
                        ->label('Tipe Banner'),

                    Forms\Components\TextInput::make('display_order')
                        ->numeric()
                        ->default(0)
                        ->required()
                        ->label('Urutan Tampil')
                        ->placeholder('Contoh: 1, 2, 3...'),

                    Forms\Components\TextInput::make('duration')
                        ->numeric()
                        ->default(10)
                        ->minValue(1)
                        ->maxValue(60)
                        ->required()
                        ->label('Durasi Tampil (Detik)')
                        ->helperText('Ketik angka 1-60 untuk waktu tampil dalam detik.'),
                ])->columns(2),

            Forms\Components\Section::make('Pengaturan Aktif & Jadwal')
                ->schema([
                    Forms\Components\Select::make('is_active')
                        ->options([
                            'active' => 'Active',
                            'not_active' => 'Not Active',
                        ])
                        ->default('active')
                        ->required()
                        ->label('Status Aktif Manual'),

                    Forms\Components\DateTimePicker::make('start_date')
                        ->label('Tanggal Mulai Aktif')
                        ->helperText('Waktu mulai banner ditampilkan (kosongkan jika langsung aktif).'),

                    Forms\Components\DateTimePicker::make('end_date')
                        ->label('Tanggal Berakhir Aktif')
                        ->helperText('Waktu banner otomatis tidak ditampilkan lagi (kosongkan jika aktif selamanya).'),
                ])->columns(3),

            Forms\Components\Section::make('Media Gambar')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->required()
                        ->image()
                        ->directory('banners')
                        ->label('Gambar Banner'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Gambar'),
                
                Tables\Columns\TextColumn::make('link')
                    ->label('Link URL')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => $state === 'banner' ? 'info' : 'warning'),

                Tables\Columns\TextColumn::make('display_order')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->suffix(' Detik')
                    ->sortable(),

                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status Manual')
                    ->badge()
                    ->color(
                        fn(string $state): string => match ($state) {
                            'active' => 'success',
                            'not_active' => 'danger',
                        },
                    ),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('display_order', 'asc')
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
            'index' => Pages\ListBannerAdvertisements::route('/'),
            'create' => Pages\CreateBannerAdvertisement::route('/create'),
            'edit' => Pages\EditBannerAdvertisement::route('/{record}/edit'),
        ];
    }
}
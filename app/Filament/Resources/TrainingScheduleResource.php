<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingScheduleResource\Pages;
use App\Models\TrainingSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrainingScheduleResource extends Resource
{
    protected static ?string $model = TrainingSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Jadwal Pelatihan';

    protected static ?string $navigationLabel = 'Jadwal Pelatihan';
    protected static ?string $pluralLabel = 'Jadwal Pelatihan';
    protected static ?string $modelLabel = 'Jadwal Pelatihan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('training_category_id')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->orderBy('sort_order', 'asc')
                    )
                    ->required()
                    ->label('Kategori Pelatihan'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Judul Pelatihan/Training')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('date')
                    ->required()
                    ->placeholder('Contoh: 14 - 16 Januari 2026')
                    ->label('Tanggal Pelaksanaan'),
                Forms\Components\TextInput::make('time')
                    ->required()
                    ->placeholder('Contoh: 08:30 - 16:00 WIB')
                    ->label('Waktu Pelaksanaan'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->placeholder('Contoh: Hotel Santika Jakarta / Zoom Online')
                    ->label('Tempat / Media'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->placeholder('Contoh: Rp 5.500.000 / Gratis')
                    ->label('Biaya / Investasi'),
                Forms\Components\TextInput::make('registration_link')
                    ->placeholder('Contoh: https://wa.me/628118087899')
                    ->url()
                    ->label('Link Pendaftaran'),
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('schedules')
                    ->label('Gambar Thumbnail (Opsional)')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Status Aktif'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Training')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal'),
                Tables\Columns\TextColumn::make('location')
                    ->label('Tempat/Media'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Investasi'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori'),
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
            'index' => Pages\ListTrainingSchedules::route('/'),
            'create' => Pages\CreateTrainingSchedule::route('/create'),
            'edit' => Pages\EditTrainingSchedule::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingCategoryResource\Pages;
use App\Filament\Resources\TrainingCategoryResource\RelationManagers;
use App\Models\TrainingCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingCategoryResource extends Resource
{
    protected static ?string $model = TrainingCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    protected static ?string $navigationGroup = 'Jadwal Pelatihan';
    protected static ?string $navigationLabel = 'Urutan Kategori';
    protected static ?string $pluralLabel = 'Urutan Kategori';
    protected static ?string $modelLabel = 'Urutan Kategori';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->label('Urutan Tampilan Kategori')
                    ->helperText('Semakin kecil angkanya, kategori akan semakin di atas (contoh: 1 paling atas, lalu 2, dst)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Urutan'),
            ])
            ->defaultSort('sort_order', 'asc')
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingCategories::route('/'),
            'create' => Pages\CreateTrainingCategory::route('/create'),
            'edit' => Pages\EditTrainingCategory::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Models\FooterSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    
    protected static ?string $navigationGroup = 'Settings';
    
    protected static ?string $pluralModelLabel = 'Pengaturan Footer';
    
    protected static ?string $modelLabel = 'Pengaturan Footer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Umum & Sosmed')
                            ->schema([
                                Forms\Components\TextInput::make('company_name')
                                    ->label('Nama Instansi / Perusahaan')
                                    ->required(),
                                Forms\Components\TextInput::make('company_slogan')
                                    ->label('Slogan / Tagline')
                                    ->required(),
                                Forms\Components\TextInput::make('company_profile_link')
                                    ->label('Link Download Company Profile (WhatsApp/URL)')
                                    ->required()
                                    ->url(),
                                Forms\Components\Section::make('Sosial Media')
                                    ->schema([
                                        Forms\Components\TextInput::make('instagram_url')
                                            ->label('Instagram URL')
                                            ->url(),
                                        Forms\Components\TextInput::make('tiktok_url')
                                            ->label('TikTok URL')
                                            ->url(),
                                        Forms\Components\TextInput::make('whatsapp_url')
                                            ->label('WhatsApp URL (e.g. https://wa.me/...)')
                                            ->url(),
                                        Forms\Components\TextInput::make('email_address')
                                            ->label('Email Link (e.g. mailto:info@...)')
                                            ->required(),
                                    ])->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Deskripsi Perusahaan')
                            ->schema([
                                Forms\Components\TextInput::make('description_title')
                                    ->label('Judul Deskripsi (Contoh: (PT. SIAP INDONESIA GROUP))')
                                    ->required(),
                                Forms\Components\Textarea::make('description_1')
                                    ->label('Deskripsi 1 (SIAP Indonesia)')
                                    ->rows(3)
                                    ->required(),
                                Forms\Components\Textarea::make('description_2')
                                    ->label('Deskripsi 2 (SIAP Keprotokolan)')
                                    ->rows(3)
                                    ->required(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Informasi Lainnya (Quick Links)')
                            ->schema([
                                Forms\Components\Repeater::make('quick_links')
                                    ->label('Daftar Tautan Cepat')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->label('Nama Menu / Label')
                                            ->required(),
                                        Forms\Components\TextInput::make('url')
                                            ->label('URL Tujuan (Contoh: /profil atau https://...)')
                                            ->required(),
                                    ])
                                    ->columns(2)
                                    ->createItemButtonLabel('Tambah Tautan Baru')
                                    ->grid(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Kontak & Hak Cipta')
                            ->schema([
                                Forms\Components\Textarea::make('office_address')
                                    ->label('Alamat Kantor')
                                    ->rows(2)
                                    ->required(),
                                Forms\Components\TextInput::make('office_phone')
                                    ->label('Nomor Telepon Kantor')
                                    ->required(),
                                Forms\Components\TextInput::make('office_mobile')
                                    ->label('Nomor HP / Mobile')
                                    ->required(),
                                Forms\Components\TextInput::make('office_email')
                                    ->label('Alamat Email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('copyright_text')
                                    ->label('Teks Hak Cipta (Copyright)')
                                    ->required(),
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Nama Perusahaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('office_phone')
                    ->label('Telepon'),
                Tables\Columns\TextColumn::make('office_email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y, H:i')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Disable bulk delete
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
            'index' => Pages\ListFooterSettings::route('/'),
            'edit' => Pages\EditFooterSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}

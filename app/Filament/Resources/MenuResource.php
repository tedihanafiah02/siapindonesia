<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $navigationGroup = 'Menu & Halaman';

    protected static ?string $navigationLabel = 'Kelola Menu';

    protected static ?string $modelLabel = 'Menu & Halaman';

    protected static ?string $pluralModelLabel = 'Menu & Halaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section 1: Struktur & Navigasi Menu
                Forms\Components\Section::make('Struktur & Navigasi Menu')
                    ->description('Atur posisi menu di navbar utama website Anda.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                            ->label('Nama Menu / Sub-Menu')
                            ->helperText('Masukkan nama menu. Contoh: "ISO" (untuk menu utama) atau "ISO 9001:2015" (untuk sub-menu).'),
                            
                        Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->placeholder('Pilih Menu Induk (Kosongkan jika ini Menu Utama)')
                            ->label('Menu Induk (Parent)')
                            ->helperText('PENTING: Pilih menu di atasnya jika menu ini adalah sub-menu. Contoh: jika Anda membuat menu "Basic Safety", pilih induknya "HSE". Jika menu ini adalah menu utama di navbar (seperti "ISO" atau "Layanan Kami"), kosongkan saja.')
                            ->nullable(),
                            
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Alamat Link (Slug)')
                            ->helperText('Akan terisi otomatis dari Nama Menu. Ini adalah teks yang muncul di alamat browser (contoh: siapindonesia.com/program/nama-slug).'),
                            
                        Forms\Components\TextInput::make('order_priority')
                            ->numeric()
                            ->default(0)
                            ->label('Nomor Urut Tampilan')
                            ->helperText('Mengatur posisi menu di navbar. Nilai lebih kecil (seperti 1, 2, 3) akan tampil lebih kiri/atas daripada nilai besar (seperti 99).'),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->label('Tampilkan di Website (Aktif)')
                            ->helperText('Jika dimatikan, menu ini tidak akan muncul di navbar maupun halaman website.'),
                            
                        Forms\Components\Toggle::make('has_page')
                            ->default(false)
                            ->reactive()
                            ->label('Memiliki Halaman Detail Sendiri?')
                            ->helperText('PENTING: Nyalakan (Centang) jika menu/sub-menu ini adalah tingkat akhir yang memiliki info pelatihan lengkap (Latar Belakang, Tujuan, Garis Besar, Fasilitas, dll). Matikan jika menu ini hanya berupa Kategori/Menu Perantara yang ketika diklik akan menampilkan daftar kartu sub-menu di dalamnya.'),
                            
                        Forms\Components\TextInput::make('url')
                            ->visible(fn (Get $get) => !$get('has_page'))
                            ->label('Link Eksternal (Opsional)')
                            ->helperText('Gunakan ini hanya jika menu ini ingin langsung membuka link web eksternal lain ketika diklik (biasanya dikosongkan).'),
                    ])->columns(2),
                    
                // Section 2: Isi Konten Halaman Pelatihan
                Forms\Components\Section::make('Isi Konten Halaman Pelatihan')
                    ->description('Masukkan informasi detail program pelatihan yang akan tampil saat menu ini diklik.')
                    ->visible(fn (Get $get) => $get('has_page'))
                    ->schema([
                        Forms\Components\FileUpload::make('banner_path')
                            ->image()
                            ->directory('banners')
                            ->label('Gambar Banner Latar Belakang')
                            ->helperText('Gambar latar belakang di bagian atas (hero banner) halaman detail program ini.'),
                            
                        Forms\Components\TextInput::make('title')
                            ->placeholder('Masukkan judul pelatihan, kosongkan untuk menggunakan nama menu')
                            ->label('Judul Besar di Halaman')
                            ->helperText('Judul besar yang tampil di dalam banner halaman. Kosongkan jika ingin menyamakan dengan nama menu.'),
                            
                        Forms\Components\TextInput::make('slogan')
                            ->placeholder('Slogan / deskripsi pendek di bawah judul')
                            ->label('Slogan Halaman')
                            ->helperText('Kalimat ajakan pendek atau slogan yang tampil di bawah judul banner.'),

                        Forms\Components\TextInput::make('icon')
                            ->default('fa-graduation-cap')
                            ->placeholder('Contoh: fa-award, fa-users-cog')
                            ->label('Ikon FontAwesome (untuk Banner)')
                            ->helperText('Nama ikon FontAwesome untuk pemanis tampilan (contoh: fa-award, fa-graduation-cap).'),
                            
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Singkat')
                            ->helperText('Ringkasan singkat tentang program pelatihan ini.')
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('background')
                            ->label('Latar Belakang')
                            ->helperText('Mengapa pelatihan ini penting? (Latar belakang masalah/kebutuhan organisasi).')
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('objectives')
                            ->label('Tujuan Pelatihan')
                            ->helperText('Apa yang akan dicapai oleh peserta setelah mengikuti pelatihan ini?')
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('syllabus')
                            ->label('Materi / Garis Besar Pelatihan')
                            ->helperText('Garis besar materi/silabus yang diajarkan (kurikulum pelatihan).')
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('benefits')
                            ->label('Manfaat Pelatihan')
                            ->helperText('Keuntungan nyata yang diperoleh peserta atau perusahaan.')
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('facilities_online')
                            ->label('Fasilitas Online Training')
                            ->helperText('Fasilitas yang didapat peserta untuk kelas Online/Daring.')
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('facilities_offline')
                            ->label('Fasilitas Offline Training')
                            ->helperText('Fasilitas yang didapat peserta untuk kelas Offline/Tatap Muka langsung.')
                            ->columnSpanFull(),
                            
                        Forms\Components\FileUpload::make('gallery')
                            ->multiple()
                            ->image()
                            ->directory('menu-gallery')
                            ->label('Galeri Foto Pelatihan')
                            ->helperText('Unggah dokumentasi foto kegiatan jika ada.')
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('cta_text')
                            ->placeholder('Hubungi WhatsApp')
                            ->label('Teks Tombol CTA (Call to Action)')
                            ->helperText('Teks tombol hubungi kami. Default: "Hubungi WhatsApp".'),
                            
                        Forms\Components\TextInput::make('cta_url')
                            ->placeholder('Link WhatsApp atau Form Pendaftaran')
                            ->label('Link URL CTA')
                            ->helperText('Link custom tujuan tombol. Jika dikosongkan, otomatis mengarah ke WhatsApp Admin utama.'),
                    ])->columns(2),
                    
                // Section 3: Pengaturan SEO (Google Search)
                Forms\Components\Section::make('Pengaturan SEO (Mesin Pencari Google)')
                    ->description('Atur bagaimana halaman ini tampil di hasil pencarian Google agar mudah ditemukan.')
                    ->visible(fn (Get $get) => $get('has_page'))
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('SEO Title')
                            ->helperText('Judul halaman di hasil pencarian Google (disarankan 50-60 karakter).'),
                            
                        Forms\Components\Textarea::make('seo_description')
                            ->label('Meta Description')
                            ->helperText('Deskripsi singkat di bawah judul pencarian Google (disarankan 150-160 karakter).'),
                            
                        Forms\Components\TextInput::make('seo_keywords')
                            ->placeholder('Contoh: sertifikasi, pelatihan hse, basic safety')
                            ->label('Meta Keywords (Kata Kunci)')
                            ->helperText('Kata kunci penunjang yang dipisahkan dengan tanda koma.'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Menu / Sub-Menu')
                    ->html()
                    ->formatStateUsing(function (Menu $record, $state) {
                        $depth = 0;
                        $parent = $record->parent;
                        while ($parent) {
                            $depth++;
                            $parent = $parent->parent;
                        }
                        if ($depth === 0) {
                            return '<span class="font-bold text-zinc-100">' . e($state) . '</span>';
                        }
                        $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $depth);
                        return $indent . '<span class="text-yellow-500 font-bold mr-1">↳</span> <span class="text-zinc-300">' . e($state) . '</span>';
                    }),
                    
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Menu Induk')
                    ->sortable()
                    ->placeholder('Menu Utama (Root)'),
                    
                Tables\Columns\TextColumn::make('slug')
                    ->label('URL Slug'),
                    
                Tables\Columns\TextColumn::make('order_priority')
                    ->label('Nomor Urut')
                    ->sortable(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->label('Aktif'),
                    
                Tables\Columns\IconColumn::make('has_page')
                    ->boolean()
                    ->sortable()
                    ->label('Halaman Detail'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}

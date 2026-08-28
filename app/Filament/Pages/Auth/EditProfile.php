<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Render inline CSS directly on the page to override simple layout and center the card
                Placeholder::make('profile_layout_override')
                    ->hiddenLabel()
                    ->content(new HtmlString('
                        <style>
                            @media (min-width: 1024px) {
                                /* Reset flex-row split screen to a centered layout */
                                .fi-simple-layout {
                                    display: flex !important;
                                    flex-direction: column !important;
                                    justify-content: center !important;
                                    align-items: center !important;
                                    min-height: 100vh !important;
                                    background-color: #080a0f !important;
                                    padding: 2rem !important; /* Reduced padding for closer fit */
                                    box-sizing: border-box !important;
                                }

                                /* Hide left panel image and tagline text */
                                .fi-simple-layout::before,
                                .fi-simple-layout::after {
                                    display: none !important;
                                    content: none !important;
                                }

                                /* Center and size the form container - wider for side-by-side panels */
                                .fi-simple-layout .fi-simple-main-ctn {
                                    width: 100% !important;
                                    max-width: 960px !important; /* Compact width for side-by-side */
                                    margin: 0 auto !important;
                                    padding: 0 !important;
                                    display: flex !important;
                                    flex-direction: column !important;
                                    justify-content: center !important;
                                    z-index: 3 !important;
                                }

                                .fi-simple-card {
                                    width: 100% !important;
                                    padding: 1.75rem !important; /* Reduced padding to bring content closer to borders */
                                    box-sizing: border-box !important;
                                }
                            }
                        </style>
                    ')),

                Grid::make([
                    'default' => 1,
                    'lg' => 2,
                ])
                ->schema([
                    Section::make('Informasi Profil')
                        ->description('Perbarui informasi profil akun, alamat email, dan foto profil Anda.')
                        ->schema([
                            FileUpload::make('avatar_url')
                                ->label('Foto Profil')
                                ->image()
                                ->avatar()
                                ->directory('avatars')
                                ->maxSize(2048)
                                ->alignCenter()
                                ->columnSpanFull(),
                                
                            $this->getNameFormComponent()
                                ->prefixIcon('heroicon-m-user'),
                            $this->getEmailFormComponent()
                                ->prefixIcon('heroicon-m-envelope'),
                        ]),

                    Section::make('Perbarui Password')
                        ->description('Pastikan akun Anda menggunakan password acak yang panjang dan aman.')
                        ->schema([
                            $this->getPasswordFormComponent()
                                ->prefixIcon('heroicon-m-key')
                                ->placeholder('Masukkan password baru'),
                            $this->getPasswordConfirmationFormComponent()
                                ->prefixIcon('heroicon-m-key')
                                ->placeholder('Masukkan konfirmasi password baru'),
                        ]),
                ])
                ->columnSpanFull(),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getCancelFormAction(),
            Action::make('dashboard')
                ->label('Dashboard')
                ->icon('heroicon-m-home')
                ->color('gray')
                ->url(url('/admin')),
        ];
    }
}

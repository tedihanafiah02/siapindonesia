<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    public function getHeading(): \Illuminate\Contracts\Support\Htmlable|string
    {
        return 'Silakan Login';
    }
}

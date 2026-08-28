<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public $setting;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->setting = cache()->rememberForever('footer_setting', function () {
            return \App\Models\FooterSetting::first();
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
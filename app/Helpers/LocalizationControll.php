<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LocalizationControll
{

    public static function setLocal()
    {
        $locale = session()->get('lang');
        if ($locale == 'en') {
            session()->forget('lang');
            session()->put('lang', 'en');
            App::setLocale('en');
        } else if ($locale == 'ar') {
            session()->forget('lang');
            session()->put('lang', 'ar');
            App::setLocale('ar');
        } else {
            session()->forget('lang');
            session()->put('lang', 'ar');
            App::setLocale('ar');
        }
    }
}

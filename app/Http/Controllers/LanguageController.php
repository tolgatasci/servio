<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang): RedirectResponse
    {
        if (array_key_exists($lang, config('app.languages'))) {
            Session::put('applocale', $lang);
        }

        return Redirect::back();
    }
}

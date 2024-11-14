<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('applocale', config('app.fallback_locale'));
        App::setLocale($locale);

        return $next($request);
    }
}

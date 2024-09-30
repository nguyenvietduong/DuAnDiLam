<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetTheme
{
    public function handle($request, Closure $next)
    {
        // Check if 'theme' is present in the session
        if (session()->has('theme')) {
            $theme = session('theme');
            config(['app.theme' => $theme]); // Set the theme in the app config
        }

        return $next($request);
    }
}

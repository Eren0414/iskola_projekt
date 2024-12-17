# Hitelesítés

## httpOnly
A token a fejlécben utazgat oda-vissza httpOnly süti formájában
Ez ezért jó, mert js-ből a kliens oldalon nem lehet kiolvasni
[Minta videó](https://www.youtube.com/watch?v=jIzPuM76-nI&list=PLlameCF3cMEs7ErSWENv03zOKtH5NTG61&index=1)
[Hitelseítés Gemini](https://g.co/gemini/share/c4e5153ca78a)

## A middleware módosítása
- Auth middleware létrehozása: `php artisan make:middleware AuthenticateMy`


<?php

use App\Http\Middleware\AuthenticateMy;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(AuthenticateMy::class); // Add the middleware here
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();



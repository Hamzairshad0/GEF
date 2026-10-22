<?php

/*
| Vercel serverless entry point (vercel-php runtime). Every request that is not
| a static file in public/ is rewritten here by vercel.json.
*/

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());

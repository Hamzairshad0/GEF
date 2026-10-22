<?php

/*
| Router for PHP's built-in server that works from any working directory:
| php -S 127.0.0.1:8000 -t public server.php
| (Laravel's own router assumes the current directory is public/.)
*/

$publicPath = __DIR__.'/public';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '');

if ($uri !== '/' && is_file($publicPath.$uri)) {
    return false;
}

chdir($publicPath);
require_once $publicPath.'/index.php';

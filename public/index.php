<?php

use Framework\Route\Route;

$env = parse_ini_file(__DIR__ . '/../.env');
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}

require "../autoload.php";

require '../routes/web.php';

Route::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
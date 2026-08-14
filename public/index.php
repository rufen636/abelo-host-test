<?php

use Framework\Route\Route;

require "../autoload.php";

require '../routes/web.php';

Route::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
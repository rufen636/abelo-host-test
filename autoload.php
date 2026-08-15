<?php

$autoload = function ($class) use (&$autoload) {
    $prefixes = [
        'App\\' => __DIR__ . '/app/',
        'Framework\\' => __DIR__ . '/framework/',
    ];

    foreach ($prefixes as $prefix => $base_dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) === 0) {
        $relative_class = substr($class, $len);
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require $file;
        }
        return;
        }
    }

    $file = __DIR__ . '/framework/DataBase/Singleton/' . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
};

spl_autoload_register($autoload);

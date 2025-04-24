<?php
spl_autoload_register(function ($class) {
    $path = __DIR__ . '/classes/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

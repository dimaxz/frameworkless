#!/usr/bin/env php
<?php
foreach (['/../../autoload.php', '/../vendor/autoload.php', '/vendor/autoload.php'] as $file) {
    $pathname = __DIR__ . $file;
    if (file_exists($pathname)) {
        require_once $pathname;
        break;
    }
}
if (!class_exists("Frameworkless\Console\Application")) {
    echo "Please run composer install" . PHP_EOL;
    die(1);
}

$console = new Frameworkless\Console\Application();

$console->run();
#!/usr/bin/env php
<?php
require_once '/vendor/autoload.php';
require_once '/bootstrap/config.php';

if (!class_exists("Frameworkless\Console\Application")) {
    echo "Please run composer install" . PHP_EOL;
    die(1);
}

use Symfony\Component\Console\Application;
use Frameworkless\Console\Commands;

$command = new Commands\InfoCommand();
$application = new Application();
$application->add($command);
$application->setDefaultCommand($command->getName());

$application->add(new Commands\InstallPackagesCommand);
$application->add(new Commands\SeedCommand);

$application->run();

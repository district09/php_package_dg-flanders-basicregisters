<?php

/**
 * Bootstrap file for all examples.
 */

// Error reporting.
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
date_default_timezone_set('Europe/Brussels');

// CLI only.
if (PHP_SAPI !== 'cli') {
    exit('This example should only be run from a Command Line Interface.' . PHP_EOL);
}

// Get the local config file.
$configFile = __DIR__ . '/config.php';
if (!file_exists($configFile)) {
    exit('Config file is missing. See README.md how to create one.' . PHP_EOL);
}
require_once __DIR__ . '/config.php';

// AutoLoader to get all required libraries.
require_once __DIR__ . '/../vendor/autoload.php';

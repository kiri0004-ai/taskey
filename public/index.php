<?php

require __DIR__ . '/../vendor/autoload.php';

use Framework\Kernel;

use Framework\Request;

$kernel = new Kernel();

// Extract the path from the URL
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!is_string($urlPath)) {
    $urlPath = '/';
}

$request = new Request($_SERVER['REQUEST_METHOD']);

$response = $kernel->handle($request);

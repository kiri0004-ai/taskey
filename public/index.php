<?php

// Autoload dependencies and classes
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Framework\Kernel;
use Framework\Request;

// Initialize the Kernel
$kernel = new Kernel();

// Define routes
$router = $kernel->getRouter();
$homeController = new HomeController();
$router->addRoute('GET', '/', [$homeController, "index"]);
$router->addRoute('GET', '/about', [$homeController, "about"]);

$taskController = new TaskController();
$router->addRoute('GET', '/tasks', [$taskController, "index"]);
$router->addRoute('GET', '/tasks/create', [$taskController, "create"]);

// Get Request data from the global variables
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Extract the path from the URL
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!is_string($urlPath)) {
    $urlPath = '/';
}

// Get query (GET) parameters
$queryParams = $_GET;

// Get POST data
$postData = $_POST;

// Create the Request object
$request = new Request($method, $urlPath, $queryParams, $postData);

// Handle the request and get the response
$response = $kernel->handle($request);

// Send the response to the client
$response->echo();

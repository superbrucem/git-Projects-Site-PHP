<?php
require_once 'vendor/autoload.php';

use PHPAdvanced\Router;
use PHPAdvanced\Controllers\HomeController;
use PHPAdvanced\Controllers\UserController;

// Error reporting configuration
$environment = getenv('APP_ENV') ?: 'development';
if ($environment === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Initialize router
$router = new Router();

// Define routes
$router->addRoute('/', [UserController::class, 'listUsers']);
$router->addRoute('/users/{id:\d+}', [UserController::class, 'getUser']);

// Dispatch the request
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($uri);
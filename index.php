<?php
require_once 'vendor/autoload.php';

use PHPAdvanced\Router;
use PHPAdvanced\Controllers\HomeController;
use PHPAdvanced\Controllers\UserController;
use PHPAdvanced\Controllers\CustomerController;

// Error reporting configuration
$environment = getenv('APP_ENV') ?: 'development';
if ($environment === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Initialize router
$router = new Router();

// Add routes for different grid implementations
$router->addRoute('/', [HomeController::class, 'index']);
$router->addRoute('/datatables', [HomeController::class, 'datatables']);
$router->addRoute('/tabulator', [HomeController::class, 'tabulator']);
$router->addRoute('/webix', [HomeController::class, 'webix']);
$router->addRoute('/frappe', [HomeController::class, 'frappe']);
$router->addRoute('/zinggrid', [HomeController::class, 'zinggrid']);
$router->addRoute('/angular', [HomeController::class, 'angular']);
$router->addRoute('/ag-grid', [HomeController::class, 'agGrid']);
$router->addRoute('/jqgrid', [HomeController::class, 'jqGrid']);
$router->addRoute('/handsontable', [HomeController::class, 'handsontable']);
$router->addRoute('/simple-datatables', [HomeController::class, 'simpleDatatables']);

// Dispatch the request
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($uri);




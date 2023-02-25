<?php

declare(strict_types=1);

use App\{Config, Router, App, Container};
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;

require_once __DIR__ . '/../vendor/autoload.php';

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$container = new Container();
$router = new Router($container);

$router
    ->get('/', [HomeController::class, 'index'])
    ->post('/upload', [HomeController::class, 'upload'])
    ->get('/invoices', [InvoiceController::class, 'index'])
    ->get('/invoices/create', [InvoiceController::class, 'create'])
    ->post('/invoices/create', [InvoiceController::class, 'store']);


(new App($router, ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']], new Config()))->run();
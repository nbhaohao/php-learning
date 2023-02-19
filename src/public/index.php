<?php

declare(strict_types=1);

//require_once '../app/PaymentGateway/Paddle/Transaction.php';

spl_autoload_register(function ($class) {
    $class = __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';
    require $class;
});

use App\PaymentGateway\Paddle\Transaction;

var_dump(new Transaction());
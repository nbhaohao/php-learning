<?php

declare(strict_types=1);

require_once '../PaymentProfile.php';
require_once '../Customer.php';
require_once '../Transaction.php';

$transaction = (new Transaction(100, 'Transaction 1'))
    ->addTax(8)
    ->applyDiscount(10);

$transaction->customer = new Customer();

echo $transaction->customer?->paymentProfile?->id ?? 'foo';
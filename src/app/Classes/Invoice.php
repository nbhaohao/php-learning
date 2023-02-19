<?php

namespace App\Classes;

class Invoice
{
    public function index(): string
    {
        return 'Invoices';
    }

    public function create(): string
    {
        return 'Create Invoice';
    }
}
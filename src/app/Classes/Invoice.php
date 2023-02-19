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
        return '
            <form action="/invoices/create" method="post">
                <label>Amount</label>
                <input type="text" name="amount">
            </form>
        ';
    }

    public function store(): string
    {
        return $_POST['amount'];
    }
}
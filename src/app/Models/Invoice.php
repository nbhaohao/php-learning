<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Invoice extends Model
{
    public function create(float $amount, int $userId): int
    {
        $statement = $this->db->prepare('INSERT INTO invoices(amount, user_id)VALUES(?, ?)');
        $statement->execute([$amount, $userId]);
        return (int)$this->db->lastInsertId();
    }

    public function find(int $invoiceId): array
    {
        $statement = $this->db->prepare(
            'SELECT invoices.id, amount, full_name
            FROM invoices
            LEFT JOIN users ON users.id = user_id
            WHERE invoices.id = ?
            '
        );
        $statement->execute([$invoiceId]);
        $invoice = $statement->fetch();
        return $invoice ? $invoice : [];
    }
}
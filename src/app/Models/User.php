<?php

namespace App\Models;

use App\Model;

class User extends Model
{

    public function create(string $email, string $name, bool $isActive = true): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO users (email, full_name, is_active, created_at)
                    VALUES(?, ?, ?, NOW())');
        $statement->execute([$email, $name, $isActive]);
        return (int)$this->db->lastInsertId();
    }
}
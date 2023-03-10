<?php

namespace App;

use PDO;

/**
 * @mixin PDO
 */
class DB
{

    protected PDO $PDO;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->PDO = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['pass'], $config['options'] ?? $defaultOptions);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }

    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->PDO, $name], $arguments);
    }
}
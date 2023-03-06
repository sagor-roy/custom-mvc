<?php

namespace App\Base;

class Model
{

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            return new \PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", "{$_ENV['DB_USER']}", "{$_ENV['DB_PASS']}");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function execute($query): \PDOStatement|false
    {
        $this->connect()->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchAll($query) : array | false
    {
        $stmt = $this->execute($query);
        return $stmt->fetchAll();
    }

}

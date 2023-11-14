<?php

namespace App\Base;

class Schema
{
    private $pdo;
    private $host;
    private $db;
    private $user;
    private $pass;


    public function __construct()
    {
        $this->host = env('DB_HOST');
        $this->db = env('DB_NAME');
        $this->user = env('DB_USER');
        $this->pass = env('DB_PASS');
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->pdo = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . "", "" . $this->user . "", "" . $this->pass . "");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create($tableName, $callback)
    {
        $blueprint = new Blueprint();
        $callback($blueprint);

        // Perform the actual database schema creation based on the blueprint
        $tableDefinition = $blueprint->getTableDefinition();
        $sql = "CREATE TABLE $tableName ($tableDefinition)";

        if ($this->pdo->exec($sql) !== false) {
            echo "Table '$tableName' created successfully.\n";
        } else {
            echo "Error creating table: " . implode(" ", $this->pdo->errorInfo()) . "\n";
        }
    }
}

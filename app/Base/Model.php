<?php

namespace App\Base;

class Model
{
    protected $tableName;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $getQuery;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->host = env('DB_HOST');
        $this->db = env('DB_NAME');
        $this->user = env('DB_USER');
        $this->pass = env('DB_PASS');
        $this->connect();
        $this->getQuery = "SELECT * FROM {$this->tableName}";
    }

    // DB Connection
    public function connect()
    {
        try {
            return new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . "", "" . $this->user . "", "" . $this->pass . "");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function where(...$conditions)
    {
        if (count($conditions) === 2) {
            // Assuming equality if only two parameters are provided
            list($column, $value) = $conditions;
            $this->getQuery .= " WHERE {$column} = " . $this->connect()->quote($value);
        } elseif (count($conditions) === 3) {
            // Assuming column, operator, and value if three parameters are provided
            list($column, $operator, $value) = $conditions;
            $this->getQuery .= " WHERE {$column} {$operator} " . $this->connect()->quote($value);
        } else {
            throw new \InvalidArgumentException('Invalid number of parameters for WHERE clause');
        }

        return $this;
    }

    // Fetch all data from Database
    public function get(): array|false
    {
        //$query = "SELECT * FROM {$this->tableName}";
        return $this->fetch($this->getQuery);
    }

    // data store method
    public function create(array $data)
    {
        $columns = "";
        $values  = "";
        foreach ($data as $key => $val) {
            $columns .= "`" . $key . "`, ";
            $values  .= $this->connect()->quote($val) . ", ";
        }
        $columns = substr($columns, 0, -2);
        $values  = substr($values, 0, -2);
        $query = "INSERT INTO `" . $this->tableName . "`(" . $columns . ") VALUES (" . $values . ")";
        $this->execute($query);
    }

    // single data get
    public function find(int|string $mixed_string)
    {
        preg_match_all('/\d+/', $mixed_string, $matches);
        $id = implode("", $matches[0]);
        $query = "SELECT * FROM {$this->tableName} WHERE id={$id}";
        $result = $this->fetch($query);
        return $result ? $result : Redirect::to('/404');
    }

    // data update
    public function update($id, $data)
    {
        $values    = "";
        foreach ($data as $key => $val) {
            $values .= "`" . $key . "` = " . $this->connect()->quote($val) . ", ";
        }
        $values  = substr($values, 0, -2);
        $query = "UPDATE {$this->tableName} SET {$values} WHERE id={$id}";
        $this->execute($query);
    }

    // data delete method
    public function delete(int|string $id): \PDOStatement|false
    {
        $query = "DELETE FROM {$this->tableName} WHERE id=$id";
        return $this->execute($query);
    }

    public function execute($query): \PDOStatement|false
    {
        $this->connect()->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetch($query): array | false
    {
        $stmt = $this->execute($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

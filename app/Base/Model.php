<?php

namespace App\Base;

class Model
{
    protected $tableName;
    private $host;
    private $db;
    private $user;
    private $pass;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->host = env('DB_HOST');
        $this->db = env('DB_NAME');
        $this->user = env('DB_USER');
        $this->pass = env('DB_PASS');
        $this->connect();
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

    // Fetch all data from Database
    public function get(): array|false
    {
        $query = "SELECT * FROM {$this->tableName}";
        return $this->fetch($query);
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
        return $result ? $result : Redirect::back('/404');
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
        return $stmt->fetchAll();
    }
}

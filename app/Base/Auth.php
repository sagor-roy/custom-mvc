<?php

namespace App\Base;

class Auth
{
    public function __construct()
    {
        $this->connect();
    }

    // DB Connection
    public function connect()
    {
        try {
            return new \PDO("mysql:host=" . env('DB_HOST') . ";dbname=" . env('DB_NAME') . "", "" . env('DB_USER') . "", "" . env('DB_PASS') . "");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function attempt($tableName, $value)
    {
        $query = "SELECT * FROM $tableName WHERE email='{$value['email']}'";
        $result = $this->fetch($query);
        if ($result) {
            if (password_verify($value['password'], $result[0]['password'])) {
                unset($result[0]['password']);
                Session::set('auth_status', true);
                Session::set('auth_info', $result);
                return true;
            }
        }
        return false;
    }

    public static function user()
    {
        return Session::get('auth_info');
    }

    public static function check()
    {
        return Session::has('auth_status') ? true : false;
    }

    public static function logout()
    {
        unset($_SESSION['auth_status']);
        unset($_SESSION['auth_info']);
        return;
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

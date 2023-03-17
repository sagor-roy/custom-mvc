<?php

namespace App\Base;

class Auth
{
    static public function attempt($tableName, $value)
    {
        $model = new Model($tableName);
        $query = "SELECT * FROM $tableName WHERE email='{$value['email']}'";
        $result = $model->fetch($query);
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
}

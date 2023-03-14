<?php

namespace App\Service;

use App\Model\User;

class UserService
{
    public static function store($data)
    {

        $user = new User;
        $user->create($data);
        return;
    }
}

<?php

namespace App\Model;

use App\Base\Model;

class User extends Model
{
    protected $table = 'user';

    public function get(): array|false
    {
        return $this->fetchAll("SELECT * FROM {$this->table}");
    }
}

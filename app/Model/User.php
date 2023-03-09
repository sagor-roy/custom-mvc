<?php

namespace App\Model;

use App\Base\Model;

class User extends Model
{
    protected $table = 'user';
    public function __construct()
    {
        parent::__construct($this->table);
    }
}

<?php

namespace App\Model;

use App\Base\Model;
use App\Base\Redirect;

class User extends Model
{
    protected $table = 'user';

    public function __construct()
    {
        parent::__construct($this->table);
    }
}

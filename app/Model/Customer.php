<?php

namespace App\Model;

use App\Base\Model;

class Customer extends Model
{
    private $table = 'customer';
    public function __construct()
    {
        parent::__construct($this->table);
    }
}

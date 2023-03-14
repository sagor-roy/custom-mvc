<?php

namespace App\Model;

use App\Base\Model;

class Student extends Model
{
    protected $table = 'student';
    public function __construct()
    {
        parent::__construct($this->table);
    }
}

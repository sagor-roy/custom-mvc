<?php

namespace App\Model;

use App\Base\Model;

class Order extends Model
{
    protected $table = 'orders';
    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function users(): array|false
    {
        return $this->belongsTo('user', 'user_id');
    }
}

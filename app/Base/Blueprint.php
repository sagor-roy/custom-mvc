<?php
namespace App\Base;

class Blueprint
{
    protected $columns = [];

    public function increments($columnName)
    {
        $this->columns[] = "$columnName INT AUTO_INCREMENT PRIMARY KEY";
        return $this;
    }

    public function string($columnName)
    {
        $this->columns[] = "$columnName VARCHAR(255)";
        return $this;
    }

    public function getTableDefinition()
    {
        return implode(", ", $this->columns);
    }
}
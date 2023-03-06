<?php

namespace App\Model;

use App\Base\Model;
use App\Base\Redirect;

class User extends Model
{
    protected $table = 'user';

    public function get(): array|false
    {
        return $this->fetchAll("SELECT * FROM {$this->table}");
    }

    public function create(array $data): \PDOStatement|false
    {
        $query = "INSERT INTO {$this->table} (`name`, `email`) VALUES ('{$data['name']}', '{$data['email']}')";
        $stmt =  $this->execute($query);
        return $stmt;
    }

    public function delete(int|string $id): \PDOStatement|false
    {
        $query = "DELETE FROM {$this->table} WHERE id=$id";
        $stmt =  $this->execute($query);
        return $stmt;
    }

    public function find($id): array|false
    {
        $result = $this->fetchAll("SELECT * FROM {$this->table} WHERE id={$id}");
        return $result ? $result : Redirect::back('/404');
    }

    public function update($data): \PDOStatement|false
    {
        $query = "UPDATE {$this->table} SET `name` = '{$data['name']}', `email` = '{$data['email']}' WHERE id = {$data['id']}";
        $stmt =  $this->execute($query);
        return $stmt;
    }
}

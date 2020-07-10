<?php namespace Models;

use \Core\Model;

class UsersModel extends Model
{
    protected string $table = "users";

    public function getUser(string $name)
    {
        $result = $this->query()
                    ->where(['name' => $name])
                    ->first();

        return ($result)
                ? $result
                : false;
    }
}
<?php namespace Models;

use \Core\Model;

class ClientsModel extends Model
{
    protected string $table = "clients";

    public function getClients()
    {
        $result = $this->query()
                       ->all();
        
        return ($result)
                ? $result
                : false;
    }
}
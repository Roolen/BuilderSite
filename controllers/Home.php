<?php namespace Controllers;

use \Core\Controller;
use \Core\View;
use \Models\ClientsModel;

class Home extends Controller
{
    public function start()
    {
        new View('home', ["name" => "Artem"]);

        $clientsModel = new ClientsModel();
        
        $client = [
            "first_name" => "Egor",
            "middle_name" => "Mihailovich",
            "last_name" => "Zhimovksij",
            "address" => "here",
            "phone" => "89045548558"
        ];

        $response = $clientsModel->query()->insert($client);
        echo var_dump($response);
    }
}
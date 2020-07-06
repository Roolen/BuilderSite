<?php namespace Controllers;

use \Core\Controller;
use \Core\View;
use \Models\ClientsModel;

class Home extends Controller
{
    public function start()
    {
        new View('header', ["title" => 'Home']);
        new View('home', ["name" => 'Artem']);
        new View('footer');

        $clientsModel = new ClientsModel();


        $response = $clientsModel->query()
                                 ->orderBy('first_name', true)
                                 ->all();

        //echo var_dump($response);
    }
}
<?php namespace Controllers;

use \Core\Controller;
use \Core\View;
use \Models\ClientsModel;

class Clients extends Controller
{
    public function start()
    {
        new View('header', ["title" => 'Clients']);

        $clientsModel = new ClientsModel();
        $clients = $clientsModel->getClients();

        new View('clients', ["clients" => $clients]);
    }
}
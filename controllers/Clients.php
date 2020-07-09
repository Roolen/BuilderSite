<?php namespace Controllers;

use \Core\Controller;
use \Core\View;
use \Models\ClientsModel;

use const \Core\RC_OK;

class Clients extends Controller
{
    public function start()
    {
        new View('header', ["title" => 'Clients']);

        $clientsModel = new ClientsModel();
        $clients = $clientsModel->getClients();

        new View('clients', ["clients" => $clients]);
    }

    public function insert()
    {
        $reqest = $this->request->json(true);

        $clientsModel = new ClientsModel();
        $status = $clientsModel->createClient($reqest);

        $this->response->setJson()->setCode(RC_OK);

        if (!$status)
        {
            return json_encode(['complete' => false]);
        }

        return json_encode(['complete' => true]);
    }
}
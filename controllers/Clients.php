<?php namespace Controllers;

use \Core\Controller;
use \Core\View;
use \Models\ClientsModel;

use const \Core\RC_OK;
use const \Core\RC_REDIRECT;
use const \Core\RC_UNAUTHORIZED;

class Clients extends Controller
{
    public function start()
    {
        session_start();
        if (!isset($_SESSION['isAuthorize']))
        {
            $this->response->redirect(\Core\App::baseUrl(), RC_REDIRECT);
        }


        new View('header', ["title" => 'Clients']);

        $clientsModel = new ClientsModel();
        $clients = $clientsModel->getClients();

        new View('clients', ["clients" => $clients]);
    }

    public function insert()
    {
        session_start();
        if (!isset($_SESSION['isAuthorize']))
        {
            $this->response->setJson()->setCode(RC_UNAUTHORIZED);
            return json_encode(['complete' => false]);
        }

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
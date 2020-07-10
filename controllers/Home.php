<?php namespace Controllers;

use \Core\Controller;
use \Core\View;
use \Models\UsersModel;

use const \Core\RC_OK;
use const \Core\RC_REDIRECT;

class Home extends Controller
{
    public function start()
    {
        $isAuthorize = false;
        session_start();
        if (isset($_SESSION['isAuthorize']))
        {
            $isAuthorize = true;
        }

        new View('header', ["title" => 'Home']);
        new View('home', ['isAuthorize' => $isAuthorize]);
        new View('footer');
    }

    public function authorize()
    {
        $request = $this->request->json(true);
        $name = $request['name'];
        $password = $request['password'];

        $usersModel = new UsersModel();
        $user = $usersModel->getUser($name);

        $this->response->setJson()->setCode(RC_OK);
        if (empty($user) && $user['password'] !== $password)
        {
            return json_encode(['complete' => false]);
        }

        session_start();
        $_SESSION['isAuthorize'] = true;
        $_SESSION['idUser'] = $user['id'];

        return json_encode(['complete' => true]);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        session_commit();

        $this->response->redirect(\Core\App::baseUrl(), RC_REDIRECT);
    }
}
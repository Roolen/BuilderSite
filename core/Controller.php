<?php namespace Core;

class Controller
{
    protected \Core\Request $request;

    protected \Core\Response $response;

    public function __construct(\Core\Request $request, \Core\Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
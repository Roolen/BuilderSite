<?php namespace Core;

class Route
{
    public $routes = [];

    public function get(string $from, string $to)
    {
        $from = str_replace('/', '\/', $from);
        $this->routes[$from] = '\\Controllers\\'.$to;
    }

    public function routeInController()
    {
        $url = $_SERVER['REQUEST_URI'];
        $rt = explode('/', $_SERVER['REQUEST_URI']);

        foreach ($this->routes as $i => $val)
        {
            if (preg_match('/^('.$i.')$/', $url))
            {
                $request = new \Core\Request();
                $response = new \Core\Response();
                $cont = new $val($request, $response);

                if (isset($rt[2]))
                {
                    $func = $rt[2];
                    echo $cont->$func();
                }
                else echo $cont->start();
            }
        }
    }
}
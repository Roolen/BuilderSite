<?php namespace Core;

class App
{
    public function start()
    {
        $paths = new \Config\Paths();
        $this->autoload($paths);

        require $paths->systemDirectory . "/Route.php";
        $route = require $paths->configDirectory . "/Routes.php";
        $route->routeInController();
    }

    private function autoload(\Config\Paths $paths)
    {
        spl_autoload_register(function ($class) use($paths) {
            if (preg_match('/^Controllers/', $class))
            {
                $class = str_replace('Controllers\\', '', $class);

                $controllerDir = $paths->controllerDirectory;
                $file = $controllerDir . DIRECTORY_SEPARATOR . $class . '.php';
                if (!file_exists($file))
                {
                    throw new \Exception("File is not found: {$file}");
                }
                require $file;
            }
            if (preg_match('/^Core/', $class))
            {
                $class = str_replace('Core\\', '', $class);

                $sysDir = $paths->systemDirectory;
                $file = $sysDir . DIRECTORY_SEPARATOR . $class . '.php';
                if (!file_exists($file))
                {
                    throw new \Exception("File is not found: {$file}");
                }
                require $file;
            }
            if (preg_match('/^Models/', $class))
            {
                $class = str_replace('Models\\', '', $class);

                $modelDir = $paths->modelDirectory;
                $file = $modelDir . DIRECTORY_SEPARATOR . $class . '.php';
                if (!file_exists($file))
                {
                    throw new \Exception("File is not found: {$file}");
                }
                require $file;
            }
            
        });
    }
}
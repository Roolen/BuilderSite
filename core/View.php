<?php namespace Core;

class View
{
    public function __construct(string $nameView, $data = [])
    {
        $paths = new \Config\Paths();

        if (is_array($data))
        {
            extract($data);
        }

        include $paths->viewDirectory . '\\' . $nameView . '.php';
    }
}
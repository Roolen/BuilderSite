<?php namespace Config;


$route = new \Core\Route();

$route->get("/", "Home");

return $route;
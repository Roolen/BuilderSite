<?php namespace Config;


$route = new \Core\Route();

$route->get("/", "Home");
$route->get("/clients", "Clients");

return $route;
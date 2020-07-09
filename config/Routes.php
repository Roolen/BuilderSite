<?php namespace Config;


$route = new \Core\Route();

$route->get("/", "Home");
$route->get("/clients", "Clients");
$route->get("/clients/insert", "Clients");

return $route;
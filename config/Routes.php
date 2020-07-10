<?php namespace Config;


$route = new \Core\Route();

$route->get("/", "Home");
$route->get("/clients", "Clients");
$route->get("/clients/insert", "Clients");
$route->get("/home/authorize", "Home");
$route->get("/home/logout", "Home");

return $route;
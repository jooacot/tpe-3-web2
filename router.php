<?php
require_once './libs/Router.php';
require_once './app/controller/travels.api.controller.php';

$router = new Router();

//                 endpoint      verbo   controller            funcion
$router->addRoute('viajes',     'GET', 'TravelsApiController', 'get');
$router->addRoute('viajes/:ID', 'GET', 'TravelsApiController', 'get');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
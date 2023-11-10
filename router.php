<?php
require_once './libs/Router.php';
require_once './app/controller/travels.api.controller.php';

$router = new Router();

//                 endpoint  metodo   controller            funcion
$router->addRoute('viajes', 'GET', 'TravelsApiController', 'getAll');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
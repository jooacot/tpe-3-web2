<?php

require_once './app/model/travels.model.php';
require_once './app/views/api.view.php';

class TravelsApiController{
    private $model;
    private $view;
    function __construct(){
        $this->model = new TravelsModel();
        $this->view = new ApiView();
    }
    function getAll(){
        $travels = $this->model->getTravels();
        $this->view->response($travels, 200);
    }
}
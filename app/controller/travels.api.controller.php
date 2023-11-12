<?php

require_once './app/model/travels.model.php';
require_once './app/views/api.view.php';

class TravelsApiController
{
    private $model;
    private $view;
    function __construct()
    {
        $this->model = new TravelsModel();
        $this->view = new ApiView();
    }
    function get($params = [])
    {
        $id = $params[':ID'];
        if (empty($params)) {
            $travels = $this->model->getTravels();
            $this->view->response($travels, 200);
        } else {
            $travel = $this->model->getDetailsById($id);
            var_dump($travel);
            if ($travel) {
                $this->view->response($travel, 200);
            } else {
                $this->view->response(
                    ['error' => 'la tarea con el id ' . $id . 'no existe'],
                    404
                );
            }
        }
    }
    function create(){
        
    }
}

<?php

require_once './app/model/travels.model.php';
require_once './app/controller/api.controller.php';

class TravelsApiController extends ApiController
{
    private $model;
    

    function __construct() {
        parent::__construct();
        $this->model = new TravelsModel();
    }

    function get($params = [])
    {
        if (empty($params)) {
   
            $sort = isset($_GET['sort']) ? $_GET['sort'] : null;
            $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
      
            $orderQuery = '';
            $acceptedOrders = ['ASC','DESC'];
      
            if (isset($sort)) {
              if ($this->model->viajesHasColumn($sort) && in_array(strtoupper($order),$acceptedOrders)) {
                $orderQuery = 'ORDER BY '.$sort.' '.$order;
              }else{
                $this->view->response(['response' => 'Bad Request'],400);
                return;
              }
            }
            
            $travels = $this->model->getTravels($orderQuery);
            $this->view->response($travels, 200);
        } else {
            $id = $params[':ID'];
            $travel = $this->model->getDetailsById($id); 
             if ($travel) {
                $this->view->response($travel, 200);
            } else {
                $this->view->response(
                    ['error' => 'la tarea con el id ' . $id . ' no existe'],
                    404
                );
            }
        }
    }
    function create() {
        $body = $this->getData();

        $destino = $body->destino;
        $precio = $body->precio;
        $fecha_ida = $body->fecha_ida;
        $fecha_vuelta = $body->fecha_vuelta;
        $id_usuario = $body->id_usuario;

        if (empty($destino) || empty($precio) || empty($fecha_ida) || empty($fecha_vuelta) || empty($id_usuario))  {
            $this->view->response("Faltan completar datos", 400);
        } else {
            $id = $this->model->insertTravel($destino, $precio, $fecha_ida, $fecha_vuelta, $id_usuario);
            $travel = $this->model->getDetailsById($id);
            $this->view->response($travel, 201);
        }
    }
    function update($params = []) {
        $id = $params[':ID'];
        $travel = $this->model->getDetailsById($id);

        if($travel) {
            $body = $this->getData();
            $destino = $body->destino;
            $precio = $body->precio;
            $fecha_ida = $body->fecha_ida;
            $fecha_vuelta = $body->fecha_vuelta;
            $id_usuario = $body->id_usuario;

            $this->model->updateTravel($destino, $precio, $fecha_ida, $fecha_vuelta, $id_usuario, $id);

            $this->view->response('El viaje con id = '.$id.' ha sido modificado.', 200);
        } else {
            $this->view->response('El viaje con id = '.$id.' no existe.', 404);
        }
    }

    function delete($params = []) {
        
            $id = $params[':ID'];
            $travel = $this->model->getDetailsById($id);

            if($travel) {
                $this->model->deleteTravel($id);
                $this->view->response('El viaje con id = '.$id.' ha sido borrado.', 200);
            } else {
                $this->view->response('El viaje con id = '.$id.' no existe.', 404);
            }
        

    }
}

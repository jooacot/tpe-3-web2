<?php
require_once './database/model.php';
class TravelsModel extends Model{
    function __construct()
    {
        parent::__contruct();
    }
    function getTravels($orderQuery = ''){
        $query = $this->db->prepare('SELECT * FROM viajes '.$orderQuery);
        $query->execute();
        $travels = $query->fetchAll(PDO::FETCH_OBJ);
        return $travels;
    }

    function getDetailsById($id_viajes)
    {
        $query = $this->db->prepare('SELECT * FROM viajes where id_viajes = ?');
        $query->execute([$id_viajes]);
        $details = $query->fetch(PDO::FETCH_OBJ);
        return $details;
    }
    function insertTravel($destino, $precio, $fecha_ida, $fecha_vuelta, $id_usuario)
    {
        $query = $this->db->prepare('INSERT INTO viajes (destino, precio, fecha_ida, fecha_vuelta, id_usuario) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$destino, $precio, $fecha_ida, $fecha_vuelta, $id_usuario]);
        return $this->db->lastInsertId();
    }

    function deleteTravel($id_viajes){
        $query = $this->db->prepare('DELETE FROM viajes WHERE id_viajes = ?');
        $query->execute([$id_viajes]);
    }

    function updateTravel ($destino, $precio, $fecha_ida, $fecha_vuelta, $id_usuario, $id_viajes){
        $query = $this->db->prepare('UPDATE viajes SET destino = ?, precio = ?, fecha_ida = ?, fecha_vuelta = ?, id_usuario = ? WHERE id_viajes = ?');
        $query->execute([$destino, $precio, $fecha_ida, $fecha_vuelta, $id_usuario, $id_viajes]);   
        return $query;
    }


    function viajesHasColumn($column){
        $query = $this->db->prepare("DESCRIBE viajes");
        $query->execute();
        $columnas = $query->fetchAll(PDO::FETCH_COLUMN);
  
        return in_array($column,$columnas);
      }
}

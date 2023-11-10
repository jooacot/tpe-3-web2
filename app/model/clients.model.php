<?php
require_once './database/model.php';
class ClientsModel extends Model{
    function __construct()
    {
        parent::__contruct();
    }
    function getClients(){
        $query = $this->db->prepare('SELECT * FROM clientes');
        $query->execute();
        $clients = $query->fetchAll(PDO::FETCH_OBJ);
        return $clients;
        //travels es un arreglo con los viajes
    }

    function getDetailsById($id)
    {
        $query = $this->db->prepare('SELECT * FROM clientes where id = ?');
        $query->execute([$id]);

        $details = $query->fetch(PDO::FETCH_OBJ);
        return $details;
    }
    function insertClient($nombre, $apellido, $edad)
    {
        $query = $this->db->prepare('INSERT INTO clientes (nombre, apellido, edad ) VALUES (?, ?, ?)');
        $query->execute([$nombre, $apellido, $edad]);

        return $this->db->lastInsertId();
    }

    function deleteClient($id){
        $query = $this->db->prepare('DELETE FROM clientes WHERE id = ?');
        $query->execute([$id]);
    
    }

    function updateClient ($nombre, $apellido, $edad, $id){
        $query = $this->db->prepare('UPDATE clientes SET nombre = ?, apellido = ?, edad = ? WHERE id = ?');
        $query->execute([$nombre, $apellido, $edad, $id]);   
        return $query;
    }
}

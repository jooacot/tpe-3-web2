<?php
require_once './database/model.php';
class UserModel extends Model {
    function __construct()
    {
        parent::__contruct();
    }
        public function getByUsername ($username){
            $query= $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
            $query->execute([$username]);
        
        return $query->fetch(PDO::FETCH_OBJ);
        }
    }



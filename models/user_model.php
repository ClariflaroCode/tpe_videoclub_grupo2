<?php
require_once 'model.php';

class user_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE nombre = ?');
        $query->execute([$username]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}
?>
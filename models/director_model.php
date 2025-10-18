<?php
    require_once 'config.php';
    require_once 'model.php';

    class DirectorModel extends model {

        public function __construct() {
            parent::__construct();
        }
        public function addDirector($nombre, $sexo, $reputacion, $nacimiento, $pais ) {
           $query = $this->db->prepare("INSERT INTO director(nombre, sexo, reputacion,fecha_nacimiento, pais_origen) VALUES (?,?,?,?,?)");
           return $query->execute([$nombre, $sexo, $reputacion, $nacimiento, $pais]);

        } 
       public function editDirector($id, $nombre, $sexo, $reputacion, $nacimiento, $pais) {
           $query = $this->db->prepare("UPDATE director SET nombre = ?, sexo=?,reputacion=?,fecha_nacimiento=?,pais_origen= ? WHERE id=?");
           return $query->execute([$nombre, $sexo, $reputacion, $nacimiento, $pais, $id]); //devuelve falso si no se logra editar
        }
       public function deleteDirector($id) {
           $query = $this->db->prepare("DELETE FROM director WHERE id=?");
           return $query->execute([$id]); //devolverá falso si no se logra eliminar
        }
       public function showDirectors() {
           $query = $this->db->prepare ("SELECT id, nombre, sexo, reputacion, fecha_nacimiento, pais_origen FROM director");
           $query->execute();
           $directors = $query->fetchAll(PDO::FETCH_OBJ);
           return $directors;
        }
       public function getDirectorById($id) {
            $query = $this->db->prepare("SELECT * FROM director WHERE id=?");
           $query->execute([$id]);
           $director = $query->fetch(PDO::FETCH_OBJ);
           return $director;
        }
   }
?>

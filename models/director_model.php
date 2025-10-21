<?php
    require_once 'config.php';
    require_once 'model.php';

    class DirectorModel extends model {

        public function __construct() {
            parent::__construct();
        }
        public function addDirector($nombre, $sexo, $reputacion, $nacimiento, $pais, $imagen ) {
           $query = $this->db->prepare("INSERT INTO director(nombre, sexo, reputacion,fecha_nacimiento, pais_origen, imagen) VALUES (?,?,?,?,?, ?)");
           return $query->execute([$nombre, $sexo, $reputacion, $nacimiento, $pais, $imagen]);

        } 
       public function editDirector($id, $nombre, $sexo, $reputacion, $nacimiento, $pais, $imagen) {
           $query = $this->db->prepare("UPDATE director SET nombre = ?, sexo=?,reputacion=?,fecha_nacimiento=?,pais_origen= ?, imagen=? WHERE id=?");
           return $query->execute([$nombre, $sexo, $reputacion, $nacimiento, $pais, $imagen, $id]); //devuelve falso si no se logra editar. Desp de 13 horas codeando, me olvide que habia agregado la imagen y no la modifique en el execute, fui a probar el crud a las 22hs del dia lunes 20 de octubre, previo a la entrega y no andaba el crud porque faltaba el $imagen en el execute. Historias de una guerrera saiyajin que lo dió todo y se puso a poner comentarios graciosos para no caer en la locura, shrek? burro? ya es tarde :)
        }
       public function deleteDirector($id) {
           $query = $this->db->prepare("DELETE FROM director WHERE id=?");
           return $query->execute([$id]); //devolverá falso si no se logra eliminar
        }
       public function showDirectors() {
           $query = $this->db->prepare ("SELECT * FROM director");
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

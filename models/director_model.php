<?php
   class DirectorModel() {
       function __construct() {
              
       }
       public function addDirector($nombre, $sexo, $reputacion, $nacimiento, $pais ) {
           $query->prepare("INSERT INTO director VALUES (?,?,?,?,?)")
           $query->exec([$nombre, $sexo, $reputacion, $nacimiento, $pais]);
           return lastInsertID();
       }
       public function editDirector($id, $nombre, $sexo, $reputacion, $nacimiento, $pais) {
           $query = $db->prepare("UPDATE director SET (?,?,?,?,?) WHERE id=?")
           $query->exec([$nombre, $sexo, $reputacion, $nacimiento, $pais, $id]);
       }
       public function deleteDirector($id) {
           $query = $db->prepare("DELETE FROM director WHERE id=?");
           $query->exec([$id]);
       }
       public function showDirectors() {
           $query = $db->prepare ("SELECT nombre, sexo, reputacion, fecha_nacimiento, pais_origen FROM director");
           $directors = fetchAll(PDO::FETCH_OBJ);
           return $directors;
       }
   }
?>

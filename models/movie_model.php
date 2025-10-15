<?php

require_once 'config.php';
require_once 'model.php';

class movie_model extends model {


    public function __construct() {
        parent::__construct();
    }

    public function getMovies() {
        $query = $this->db->prepare(
            'SELECT pelicula.*, director.nombre as nombre_director 
             FROM pelicula JOIN director ON pelicula.director_id = director.id'
        );
        $query->execute();
        $movies= $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }

    public function getMovieById($id) {
        $query = $this->db->prepare(
            'SELECT pelicula.*, director.nombre as nombre_director 
             FROM pelicula JOIN director ON pelicula.director_id = director.id
             WHERE pelicula.id = ?'
        );
        $query->execute([$id]);
        $movies= $query->fetch(PDO::FETCH_OBJ);

        return $movies;
    }

    public function getDirectors() {
    $query = $this->db->prepare("SELECT id, nombre FROM director");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

    public function addMovie($titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora) {
    $query = $this->db->prepare(
        'INSERT INTO pelicula (titulo, duracion,imagen, precio, descripcion, fecha_lanzamiento, atp, director_id, genero,distribuidora) 
         VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?)'
    );
    return $query->execute([$titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora]);
}

    public function updateMovie($id, $titulo, $duracion, $precio, $descripcion, $fecha_lanzamiento, $atp, $genero, $distribuidora) {
        $query = $this->db->prepare(
            'UPDATE pelicula SET titulo=?, duracion=?, precio=?, descripcion=?, fecha_lanzamiento=?, atp=? , genero=?,  distribuidora=? WHERE id=?'
        );
        return $query->execute([$titulo, $duracion, $precio, $descripcion, $fecha_lanzamiento, $atp, $genero, $distribuidora, $id]);
    }

    public function deleteMovie($id) {
        $query = $this->db->prepare('DELETE FROM pelicula WHERE id=?');
        return $query->execute([$id]);
    }
}
<?php
require_once 'models/movie_model.php';
require_once 'views/movie_view.php';
require_once 'auth_middleware.php';

class admin_controller {
    private $model;
    private $view;

    public function __construct() {
        requireAdmin();
        $this->model = new movie_model();
        $this->view = new movie_view();
    }

    public function listMovies() {
        $movies = $this->model->getMovies();
        $this->view->showAdminMovies($movies);
    }

  public function addMovieForm($error = '') {
    $directors = $this->model->getDirectors();
    $this->view->showMovieForm(null, $directors, $error);
}

    public function addMovie() {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $duracion = $_POST['duracion'];
        $fecha_lanzamiento = $_POST['fecha'];
        $imagen = $_POST['imagen'];
        $atp = $_POST['atp'];
        $distribuidora = $_POST['distribuidora'];
        $precio = $_POST['precio'];
        $director_id = $_POST['director_id'];
        $genero = $_POST['genero'];

        if($this->model->addMovie($titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora)) {
            header("Location: " . BASE_URL . "admin/movies");
        } else {
            $this->addMovieForm("Error al agregar la película.");
        }
    }

    public function editMovieForm($id, $error = '') {
    $movie = $this->model->getMovieById($id);
    $directors = $this->model->getDirectors();
    $this->view->showMovieForm($movie, $directors, $error); 
}

    public function editMovie() {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $duracion = $_POST['duracion'];
        $fecha_lanzamiento = $_POST['fecha'];
        $atp = $_POST['atp'];
        $distribuidora = $_POST['distribuidora'];
        $precio = $_POST['precio'];
        $director_id = $_POST['director_id'];
        $genero = $_POST['genero'];

        if($this->model->updateMovie($id, $titulo, $duracion, $precio, $descripcion, $fecha_lanzamiento, $atp, $genero, $distribuidora)) {
            header("Location: " . BASE_URL . "admin/movies");
        } else {
            $this->editMovieForm($id, "Error al editar la película.");
        }
    }

    public function deleteMovie($id) {
        if($this->model->deleteMovie($id)) {
            header("Location: " . BASE_URL . "admin/movies");
        } else {
            echo "Error al eliminar la película.";
        }
    }
}

<?php
require_once 'models/movie_model.php';
require_once 'views/movie_view.php';
require_once 'controllers/auth_controller.php';

class admin_controller {
    private $model;
    private $view;

    public function __construct() {
        $auth = new auth_controller();
        $this->model = new movie_model();
        $this->view = new movie_view();
    }

    public function listMovies($request) {
        $movies = $this->model->getMovies();
        $this->view->showAdminMovies($movies, $request);
    }

  public function addMovieForm($error = '', $request) {
    $directors = $this->model->getDirectors();
    $this->view->showMovieForm(null, $directors, $error, $request);
}

    public function addMovie($request) {
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
            $this->addMovieForm("Error al agregar la película.", $request);
        }
    }

    public function editMovieForm($id, $error = '', $request) {
    $movie = $this->model->getMovieById($id);
    $directors = $this->model->getDirectors();
    $this->view->showMovieForm($movie, $directors, $error, $request); 
}

    public function editMovie($request) {
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
            $this->editMovieForm($id, "Error al editar la película.", $request);
        }
    }

    public function deleteMovie($id, $request) {
        if($this->model->deleteMovie($id, $request)) {
            header("Location: " . BASE_URL . "admin/movies");
        } else {
            $this->view->showError('Error al eliminar la película', $request);
        }
    }
}

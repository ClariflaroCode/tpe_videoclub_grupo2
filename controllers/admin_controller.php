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
    $this->view->showMovieForm(null, $directors, $error); // antes showAddMovie
}

    public function addMovie() {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $director_id = $_POST['director_id'];
        $genero = $_POST['genero'];

        if($this->model->addMovie($titulo, $descripcion, $precio, $director_id, $genero)) {
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
        $precio = $_POST['precio'];
        $director_id = $_POST['director_id'];
        $genero = $_POST['genero'];

        if($this->model->updateMovie($id, $titulo, $descripcion, $precio, $genero)) {
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

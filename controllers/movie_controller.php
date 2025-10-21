<?php
require_once 'models/movie_model.php';
require 'views/movie_view.php';
require_once 'models/director_model.php';

class movie_controller {
    private $model;
    private $view;
    private $directorModel;

    public function __construct() {
        $this->model = new movie_model();
        $this->view = new movie_view();
        $this->directorModel = new DirectorModel(); //PREGUNTAR
    }

    public function showMovies($request) {
        if (!empty($_GET['director_id'])){
            $movies = $this->model->getMoviesbyDirector($_GET['director_id']);
            $director = $this->directorModel->getDirectorById($_GET['director_id'])->nombre;
            
        } else {

            $movies = $this->model->getMovies();
        }
        $directors = $this->model->getDirectors(); //los queremos para el filtrado y para mostrar a que director pertenece qué película

        $this->view->showMovies($movies, $directors, $director, $request);
    }

    public function movieExists($id) {
        $movie = $this->model->getMovieById($id);
        return !empty($movie);
}

    public function showMovie($id, $request) {
        $movie = $this->model->getMovieById($id);
        $this->view->showMovieById($movie, $request);
    }

    public function showError($error, $request) {
        $this->view->showError($error,$request);
    }

    public function showLogin($error, $request) {
        $this->view->showLogin($error,$request);
    }
}
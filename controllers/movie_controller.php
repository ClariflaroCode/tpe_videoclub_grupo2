<?php
require_once 'models/movie_model.php';
require 'views/movie_view.php';

class movie_controller {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new movie_model();
        $this->view = new movie_view();
    }

    public function showMovies() {
        if (!empty($_GET['director_id'])){
            $movies = $this->model->getMoviesbyDirector($_GET['director_id']);
        } else {

            $movies = $this->model->getMovies();
        }
        $directors = $this->model->getDirectors();

        $this->view->showMovies($movies, $directors);
    }

    public function movieExists($id) {
        $movie = $this->model->getMovieById($id);
        return !empty($movie);
}

    public function showMovie($id) {
        $movie = $this->model->getMovieById($id);
        $this->view->showMovieById($movie);
    }

    public function showError($error, $request) {
        $this->view->showError($error,$request);
    }

    public function showLogin($error, $request) {
        $this->view->showLogin($error,$request);
    }
}
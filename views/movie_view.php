<?php

class movie_view {

    function showMovies($movies, $directors, $director, $request) {
        require 'templates/header.phtml';
        require 'templates/movies_list.phtml';
        require 'templates/footer.phtml';
    }


    function showMovieById($movie, $request) {
        require 'templates/header.phtml';

        if ($movie) {
            require 'templates/movie_detail.phtml';
        } else {
            $this->showError('La película no existe', $request);
        }

        require 'templates/footer.phtml';
    }


    function showError($error) {
        echo "<h2>$error</h2>";
        echo "<a href='" . BASE_URL . "peliculas'>Volver</a>";
    }

    function showMovieError($message, $request) {
        require './templates/header.phtml';
        echo "$message";
        echo "<a href='" . BASE_URL . "peliculas'>Volver</a>";
        require 'templates/footer.phtml';
    }

    function showLogin($error = '', $request) {
        require 'templates/header.phtml';
        require 'templates/login_form.phtml';
        require 'templates/footer.phtml';
    }


    function showAdminMovies($movies, $request) {
        require 'templates/header.phtml';
        require 'templates/admin_movies.phtml';
        require 'templates/footer.phtml';
    }


    function showMovieForm($movie = null, $directors, $error = '', $request) {
        require 'templates/header.phtml';
        require 'templates/movie_form.phtml';
        require 'templates/footer.phtml';
    }
}
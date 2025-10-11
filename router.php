<?php
require_once "controllers/movie_controller.php";
require_once "controllers/admin_controller.php";
require_once "views/movie_view.php";
require_once "auth_middleware.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$controller = new movie_controller();
$admin_controller = new admin_controller();
$view = new movie_view();


if (!empty($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "peliculas";
}

$params = explode("/", $action);

switch ($params[0]) {
    case "peliculas":
        if (isset($params[1])) {
            $controller->showMovie($params[1]);
        } else {
            $controller->showMovies();
        }
        break;
    case "about":
        //TODO
        break;
    case 'login':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(login($_POST['usuario'], $_POST['password'])){
                header("Location: ".BASE_URL."peliculas");
            } else {
                $view->showLogin("Usuario o contraseña incorrecta");
            }
        } else {
            $view->showLogin();
        }   
    break;

    case "admin":
    if (!isset($params[1])) $params[1] = 'movies';
    switch($params[1]){
        case 'movies':
            $admin_controller->listMovies();
            break;
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $admin_controller->addMovie();
            } else {
                $admin_controller->addMovieForm();
            }
            break;
        case 'edit':
            $id = $params[2] ?? null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $admin_controller->editMovie();
            } else {
                $admin_controller->editMovieForm($id);
            }
            break;
        case 'delete':
            $id = $params[2] ?? null;
            $admin_controller->deleteMovie($id);
            break;
    }
    break;
    default:
        $view->showError();
        break;
    }
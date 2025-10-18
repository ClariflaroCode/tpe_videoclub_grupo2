<?php
session_start();
require_once "controllers/movie_controller.php";
require_once "controllers/admin_controller.php";
require_once "middlewares/session_middleware.php";
require_once "middlewares/guard_middleware.php";
require_once "controllers/auth_controller.php";
require_once "controllers/director_controller.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$controller = new movie_controller();
$controller_director = new DirectorController();

$sessionMiddleware = new SessionMiddleware();
$request = $sessionMiddleware->run(new stdClass());

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "peliculas";
}

$params = explode("/", $action);

switch ($params[0]) {
    case "peliculas":
        if (isset($params[1])) {
            $controller->showMovie($params[1],$request);
        } else {
            $controller->showMovies($request);
        }
        break;
        
    case "about":
        //TODO
        break;
    case 'login':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new auth_controller();
            if($auth->login($_POST['usuario'], $_POST['password'])) {
                header("Location: " . BASE_URL . "peliculas");
            } else {
                $controller->showLogin("Usuario o contraseña incorrecta", $request);
            }
        } else {
            $controller->showLogin(null, $request);
        }   
        break;
    case 'logout':
        $auth_controller_out = new  auth_controller();
        $auth_controller_out->logout($request);
        break;
    case 'directores':
        $controller_director->listDirectors();        
        break;
    case "admin":
        $guard = new GuardMiddleware();
        $request = $guard->run($request);
        $admin_controller = new admin_controller();
        if (!isset($params[1])) $params[1] = 'movies';
        switch($params[1]){
            case 'movies':
                $admin_controller->listMovies($request);
                break;
            case 'add_movie':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $admin_controller->addMovie($request);
                } else {
                    $admin_controller->addMovieForm(null,$request);
                }
                break;
            case 'edit_movie':
                $id = $params[2] ?? null;
                var_dump($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $admin_controller->editMovie($request);
                } else {
                    $admin_controller->editMovieForm($id, null, $request);
                }
                break;
            case 'delete_movie':
                $id = $params[2] ?? null;
                $admin_controller->deleteMovie($id,$request);
                break;

            case 'directors':
                $admin_controller->showDirectors($request);
                break;
            case 'add_director':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $admin_controller->addDirector($request);
                } else {
                    $admin_controller->showAddForm($request);
                }
                break;
            case 'edit_director':
                if (!empty($params[2]) && isset($params[2])) {
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $admin_controller->editDirector($params[2], $request);
                    } else {
                        $admin_controller->showEditForm($params[2], $request);
                    } 
                } else {
                    $controller->showError('Error, no se insertó un id', $request);
                }
                break;
            case 'delete_director':
                $id = $params[2] ?? null;
                $admin_controller->deleteDirector($id,$request);
                break;

        }
        break;
    default:
        $controller->showError('Error 404: Página no encontrada', $request);
        break;
    }
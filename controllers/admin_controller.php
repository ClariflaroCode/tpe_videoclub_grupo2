<?php
require_once 'models/movie_model.php';
require_once 'views/movie_view.php';
require_once 'controllers/auth_controller.php';
require_once 'models/director_model.php';
require_once 'views/director_view.php';

class admin_controller {
    private $model;
    private $view;
    private $directorModel;
    private $directorView;

    public function __construct() {
        $auth = new auth_controller();
        $this->model = new movie_model();
        $this->view = new movie_view();
        $this->directorModel = new DirectorModel();
        $this->directorView = new DirectorView();
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

    public function showDirectors($request) {
        $directors = $this->directorModel->showDirectors();

        $this->directorView->showDirectors($directors);
    }

    public function showAddForm($request) {
        $this->directorView->showForm("add_director");
    }
    
    public function showEditForm($id, $request) {
        $director = $this->directorModel->getDirectorById($id); //busca si pertenece a un director de la base de datos. 
        if ($director) {
            $this->directorView->showForm("edit_director/" . $id);
        } else {
            $this->directorView->showError("Director no encontrado");
        }
    }


    public function addDirector($request) {

        $nombre = $_POST["nombre"];
        $sexo = $_POST["sexo"];
        $reputacion = $_POST["reputacion"];
        $nacimiento = $_POST["fecha_nacimiento"];
        $pais = $_POST["pais_origen"];

        if (
            !empty($nombre) && isset($nombre) &&
            !empty($sexo) && isset($sexo) &&
            !empty($reputacion) && isset($reputacion) &&
            !empty($nacimiento) && isset($nacimiento) &&
            !empty($pais) && isset($pais) 
        ) 
        {    
            if ($this->directorModel->addDirector($nombre, $sexo, $reputacion, $nacimiento, $pais)) {
                header("Location: " . BASE_URL . "admin/directors");
            } else {
                $this->directorView->showError("Error al agregar un nuevo director");
            }
        }
        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                echo "El campo '$key' está vacío.";
                break;
            }
        }


    }

    public function editDirector($id, $request) {
        var_dump($id); 
        $nombre = $_POST["nombre"];
        $sexo = $_POST["sexo"];
        $reputacion = $_POST["reputacion"];
        $nacimiento = $_POST["fecha_nacimiento"];
        $pais = $_POST["pais_origen"];

        
        if (
            !empty($id) && isset($id) &&
            !empty($nombre) && isset($nombre) &&
            !empty($sexo) && isset($sexo) &&
            !empty($reputacion) && isset($reputacion) &&
            !empty($nacimiento) && isset($nacimiento) &&
            !empty($pais) && isset($pais) 
        ) 
        {    
            $director = $this->directorModel->getDirectorById($id); //busca si pertenece a un director de la base de datos. 
            if ($director) { //si existe el director 
                if ($this->directorModel->editDirector($id, $nombre, $sexo, $reputacion, $nacimiento, $pais)) {
                    header("Location: " . BASE_URL . "admin/directors");
                } else {
                    $this->directorView->showError("Error al editar el director");
                }

            } else {
                $this->directorView->showError("Se intentó modificar un director inexistente");
            }
        }      
        foreach ($_POST as $key => $value) {
            if (empty($value)) {//aca juancho quiere que el key quede bonito y no se llame como en la base de datos. 
                $this->showPostDirectorError("El campo '$key' está vacío.");
                break;
            }
        }

    }

    public function deleteDirector($id, $request){
        if (!empty($id) && isset($id)){
            $director = $this->directorModel->getDirectorById($id); //busca si pertenece a un director de la base de datos. 
            if ($director) { //si existe el director  {
                if ($this->directorModel->deleteDirector($id)) {
                    header("Location: " . BASE_URL . "admin/directors");
                } else {
                    $this->directorView->showError("Error al eliminar el director");
                }
            } else {
                $this->directorView->showError("Se intentó eliminar un director inexistente");
            }
        } else {
            $this->directorView->showError("Error al identificar el director a eliminar");
        }

    }
    public function showPostDirectorError($error) {
        $campos = [
            "nombre" => "nombre", 
            "sexo" => "sexo",
            "reputacion" => "reputacion",
            "fecha_nacimiento" => "fecha de nacimiento",
            "pais_origen" => "pais de origen"
        ];
        $item = "";
        foreach($campos as $campo) {
            if ($error == $campo) {
                $item = $campo;
            }
        }
        $this->directorView->showError("Falta el completar el campo ". "$item");
    }
}

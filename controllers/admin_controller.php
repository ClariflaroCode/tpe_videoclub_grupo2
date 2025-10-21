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
        //$auth = new auth_controller();
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

        $this->directorView->showDirectors($directors, $request);
    }

    public function showAddForm($request) {
        $this->directorView->showForm("add_director", null, $request);
    }
    
    public function showEditForm($id, $request) {
        $director = $this->directorModel->getDirectorById($id); //busca si pertenece a un director de la base de datos. 
        if ($director) {
            $this->directorView->showForm("edit_director/" . $id,  $director, $request);
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
        $imagen = $_POST["imagen"];

        if (
            !empty($nombre) && isset($nombre) &&
            !empty($sexo) && isset($sexo) &&
            !empty($reputacion) && isset($reputacion) &&
            !empty($nacimiento) && isset($nacimiento) &&
            !empty($pais) && isset($pais) &&
            !empty($imagen) && isset($imagen) 
        ) 
        {    
            if ($this->validateDirectorInputs($_POST)) {
                if ($this->directorModel->addDirector($nombre, $sexo, $reputacion, $nacimiento, $pais, $imagen)) {
                    header("Location: " . BASE_URL . "admin/directors");
                } else {
                    $this->directorView->showError("Error al agregar un nuevo director");
                }
            } else {
                echo "error en la validacion";
            }
        } 
        else {
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    $this->showPostDirectorError("$key");
                    break;
                }
            }

        }   


    }

    public function editDirector($id, $request) {
        $nombre = $_POST["nombre"];
        $sexo = $_POST["sexo"];
        $reputacion = $_POST["reputacion"];
        $nacimiento = $_POST["fecha_nacimiento"];
        $pais = $_POST["pais_origen"];
        $imagen = $_POST["imagen"];
        
        if (
            !empty($id) && isset($id) &&
            !empty($nombre) && isset($nombre) &&
            !empty($sexo) && isset($sexo) &&
            !empty($reputacion) && isset($reputacion) &&
            !empty($nacimiento) && isset($nacimiento) &&
            !empty($pais) && isset($pais) &&
            !empty($imagen) && isset($imagen) 
        ) 
        {    
            if ($this->validateDirectorInputs($_POST)) {
                $director = $this->directorModel->getDirectorById($id); //busca si pertenece a un director de la base de datos. 
                
                if ($director) { //si existe el director 
                    if ($this->directorModel->editDirector($id, $nombre, $sexo, $reputacion, $nacimiento, $pais, $imagen)) {
                        header("Location: " . BASE_URL . "admin/directors");
                    } else {
                        $this->directorView->showError("Error al editar el director");
                    }

                } else {
                    $this->directorView->showError("Se intentó modificar un director inexistente");
                }
            }else {
                 $this->directorView->showError("Error de validacion");
            }

        } else {
            foreach ($_POST as $key => $value) {
                if (empty($value)) {//aca juancho quiere que el key quede bonito
                    $this->showPostDirectorError("$key");
                    break;
                }
            }

        }     

    }

    public function deleteDirector($id, $request){
        if (!empty($id) && isset($id)){
            $director = $this->directorModel->getDirectorById($id); //busca si pertenece a un director de la base de datos. 
            if ($director) { //si existe el director  {
                $movies = $this->model->getMoviesByDirector($id);
                if (count($movies) == 0) {
                    if ($this->directorModel->deleteDirector($id)) {
                        header("Location: " . BASE_URL . "admin/directors");
                    } else {
                        $this->directorView->showError("Error al eliminar el director");
                    }
                } else{
                    $this->directorView->showError("No se pueden eliminar directores que tengan peliculas asociadas");
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
            "pais_origen" => "pais de origen",
            "imagen" => "imagen"
        ];
        $item = "";
        foreach($campos as $clave =>$traduccion) {
            if ($error == $clave) {
                $item = $traduccion;
                break;
            }
        }
        $this->directorView->showError("Falta completar el campo ".$item);
    }
    public function validateDirectorInputs ($data) {
        //esta funcion verifica los atributos de fecha, genero y reputacion sean válidos por si hay algún hacker por ahí dando vueltas.
        define("MIN_REPUTACION", 1);
        define("MAX_REPUTACION", 5);


        $valuesForGenero = ["m", "f"];
        if (!in_array($data['sexo'], $valuesForGenero)) {
            $this->directorView->showError("El genero no es válido");
            return false;
        }

        $fecha = $data['fecha_nacimiento'];
        $arregloFecha = explode("-", $fecha);


        //existe una funcion en php que hace lo que iba a hacer que es verificar que el mes este entre 01 y 12, 
        // los dias entre 01 y 31 y ademas verifica que el mes y el dia tengan sentido para no mandarle un 30 de febrero, epic. 
        if (count($arregloFecha) == 3) {
            $anio = (int) $arregloFecha[0]; //dato muy de lenguajes, acá php devuelve 0 si se castea un texto que no empiece con numeros y si empieza con numeros los toma y los castea a los primeros ignorando el resto del texto
            $mes = (int) $arregloFecha[1];
            $dia = (int) $arregloFecha[2];

            if (!checkdate($mes, $dia, $anio)) {
                $this->directorView->showError("La fecha es incorrecta");
                return false;
            } 
        } else {
            $this->directorView->showError("La fecha no respeta el formato");
            return false;
        }

        if (((int)$data['reputacion'] < MIN_REPUTACION) || ((int)$data['reputacion'] > MAX_REPUTACION)) {
            $this->directorView->showError("La reputacion es incorrecta, ingrese un valor entre" . MIN_REPUTACION." y ". MAX_REPUTACION);
            return false;
        }

        //quería validar que la url de la imagen sea una imagen verdaderamente verificando que termine
        //  en formatos de imagen como .jpg, .jpeg, png, etc. pero las imagenes encriptadas de google u otras redes sociales a veces 
        //no tienen esta extension o formato al final de la url... pero lo anterior se podría hacer con una expresion regular como las de ciencias 1 :)

        return true;

        
    }
}

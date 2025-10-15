<?php
    require_once 'director_model.php';
    require_once 'director_view.php';

    class DirectorController {
        private $model;
        private $view;

        function __construct() {
            $this->model = new DirectorModel();
            $this->view = new DirectorView(); 
        }
        public function addDirector($nombre, $sexo, $reputacion, $nacimiento, $pais ) {
            if (!empty($nombre) && isset($nombre)) {
                if (!empty($sexo) && isset($sexo)) {
                    if (!empty($nombre) && isset($nombre)) {
                        
                    } else {
                        $this->view->error("Falta el nombre");
                    }
                } else {
                    $this->view->error("Falta el sexo del director");
                }
            } else {
                $this->view->error("Falta el nombre");
            }
        }
        public function editDirector($id, $nombre, $sexo, $reputacion, $nacimiento, $pais ) {

        }
        public function deleteDirector($id){

        }
        public function showDirectors() {

        }
    }    

    
?>
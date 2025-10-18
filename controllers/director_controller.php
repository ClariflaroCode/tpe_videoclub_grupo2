<?php
   require_once 'models/director_model.php';
   require_once 'views/director_view.php';


   class DirectorController {
        private $model;
        private $view;


        function __construct() {
           $this->model = new DirectorModel();
           $this->view = new DirectorView();
        }

        public function showDirectors() {
            $directors = $this->model->showDirectors();
            $this->view->showDirectors($directors);
        }
        public function listDirectors() {
            $directors = $this->model->showDirectors();
            $this->view->listDirectors($directors);
        }
   }   

?>

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

        public function showDirectors($request) {
            $directors = $this->model->showDirectors();
            $this->view->showDirectors($directors, $request);
        }
        public function listDirectors($request) {
            $directors = $this->model->showDirectors();
            $this->view->listDirectors($directors, $request);
        }
   }   

?>

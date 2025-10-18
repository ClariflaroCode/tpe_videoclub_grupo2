<?php

    class DirectorView {
        function __construct() {
        
        }
        public function showDirectors($directors) {
            require_once 'templates/header.phtml';
            require_once 'templates/director_table.phtml';
            require_once 'templates/footer.phtml';
        }
        public function showForm($action_form) {
            require_once 'templates/header.phtml';
            require_once './templates/director_form.phtml';
            require_once 'templates/footer.phtml';
        }
        public function showError($error) {
            echo "$error";
        }
        public function listDirectors($directors) {
            require_once 'templates/header.phtml';
            require_once './templates/directors_list.phtml';
            require_once 'templates/footer.phtml';
        }
    }

?>

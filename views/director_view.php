<?php

    class DirectorView {
        function __construct() {
        
        }
        public function showDirectors($directors) {
            require_once 'director_table.php';
        }
        public function showForm($action_form) {
            require_once 'director_form.php';
        }
    }

?>
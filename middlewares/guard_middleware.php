<?php

require_once 'controllers/auth_controller.php'; 

class GuardMiddleware {
    public function run($request) {
        //$auth = new auth_controller(); 

        if($request->usuario) { 
            return $request;
        } else {
            header("Location: ".BASE_URL."login");
            exit();
        }
    }

}
?>
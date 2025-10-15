<?php

    class SessionMiddleware {

        public function run($request){
            if(isset($_SESSION['USER_ID'])){
                $request->usuario = new StdClass();
                $request->usuario->id = $_SESSION['USER_ID'];
                $request->usuario->nombre = $_SESSION['USER_NAME'];   
            } else {
                $request->usuario = null;
            }
            return $request;
        }

    }

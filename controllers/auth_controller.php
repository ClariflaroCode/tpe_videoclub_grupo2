<?php
require_once './models/user_model.php';
require_once './views/movie_view.php';

class auth_controller{

function isLoggedIn() {
    return !empty($_SESSION['usuario']);
}

function isAdmin() {
    return !empty($_SESSION['admin']) && $_SESSION['admin'] === true;
}

function login($usuario, $password) {
    $userModel = new user_model();
    $user = $userModel->getUserByUsername($usuario);
    if($user && password_verify($password, $user->password)){
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_NAME'] = $usuario;
        $_SESSION['admin'] = true;
        return true;
    }
    return false;
}
}
?>  
<?php
session_start();

function isLoggedIn() {
    return !empty($_SESSION['usuario']);
}

function isAdmin() {
    return !empty($_SESSION['admin']) && $_SESSION['admin'] === true;
}

function requireAdmin() {
    if(!isAdmin()){
        header("Location: " . BASE_URL . "login?error=Debe iniciar sesión como administrador");
        exit;
    }
}

function login($usuario, $password) {
    if($usuario === 'webadmin' && $password === 'admin'){
        $_SESSION['usuario'] = $usuario;
        $_SESSION['admin'] = true;
        return true;
    }
    return false;
}
?>  
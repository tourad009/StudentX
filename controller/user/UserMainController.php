<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once("UserController.php");

    // creation d'un objet UserController
    $userController = new UserController();

    // Authetification
    if (isset($_POST['formLogin'])) {
        // appel de la methode auth
        $userController->auth(); 
    }

    // Deconnexion
    if (isset($_GET['logout'])) {
        // appel de la methode logout
        $userController->logout(); 
    }

?>
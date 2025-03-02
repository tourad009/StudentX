<?php
require_once "StudentController.php";

$controller = new StudentController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'ajouter':
            $controller->addStudent($_POST['nom'], $_POST['email'], $_POST['password'], $_POST['matricule'], $_POST['tel'], $_POST['adresse']);
            break;
        case 'modifier':
            $controller->updateStudent($_POST['id'], $_POST['nom'], $_POST['email'], $_POST['matricule'], $_POST['tel'], $_POST['adresse']);
            break;
        case 'supprimer':
            $controller->deleteStudent($_POST['id']);
            break;
        case 'activer':
            $controller->activateStudent($_POST['id']);
            break;
        case 'desactiver':
            $controller->deactivateStudent($_POST['id']);
            break;
    }

    header("Location: ../../views/admin/etudiant.php");
    exit;
}
?>

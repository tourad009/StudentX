<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/StudentX/controller/etudiant/StudentController.php";

$controller = new StudentController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    try {
        switch ($_POST['action']) {
            case 'ajouter':
                $controller->addStudent(
                    $_POST['nom'],
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['matricule'],
                    $_POST['tel'],
                    $_POST['adresse']
                );
                $_SESSION['success_message'] = "Étudiant ajouté avec succès.";
                break;

            case 'modifier':
                $controller->updateStudent(
                    $_POST['id'],
                    $_POST['nom'],
                    $_POST['email'],
                    $_POST['matricule'],
                    $_POST['tel'],
                    $_POST['adresse']
                );
                $_SESSION['success_message'] = "Étudiant modifié avec succès.";
                break;

            case 'supprimer':
                $controller->deleteStudent($_POST['id']);
                $_SESSION['success_message'] = "Étudiant supprimé avec succès.";
                break;

            case 'activer':
                $controller->activateStudent($_POST['id']);
                break;

            case 'desactiver':
                $controller->deactivateStudent($_POST['id']);
                break;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Erreur : " . $e->getMessage();
    }

    // Redirection vers la liste des étudiants en utilisant la route définie dans .htaccess
    header("Location: listeEtudiants");
    exit;
}
?>

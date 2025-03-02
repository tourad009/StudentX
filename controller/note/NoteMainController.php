<?php
require_once "NoteController.php";

$controller = new NoteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'ajouter':
            $controller->addNote($_POST['note'], $_POST['idEtudiant'], $_POST['idEvaluation']);
            break;
        case 'modifier':
            $controller->updateNote($_POST['id'], $_POST['note']);
            break;
        case 'supprimer':
            $controller->deleteNote($_POST['id']);
            break;
    }

    header("Location: ../../views/admin/note.php");
    exit;
}
?>

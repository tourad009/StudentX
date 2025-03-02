<?php
session_start();
require_once "EvaluationController.php";

$controller = new EvaluationController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    try {
        switch ($_POST['action']) {
            case 'ajouter':
                $controller->addEvaluation(
                    $_POST['nom'],
                    $_POST['semestre'],
                    $_POST['type']
                );
                $_SESSION['success_message'] = "Évaluation ajoutée avec succès.";
                break;

            case 'modifier':
                $controller->updateEvaluation(
                    $_POST['evaluation_id'],
                    $_POST['nom'],
                    $_POST['semestre'],
                    $_POST['type']
                );
                $_SESSION['success_message'] = "Évaluation modifiée avec succès.";
                break;

            case 'supprimer':
                $controller->deleteEvaluation($_POST['evaluation_id']);
                $_SESSION['success_message'] = "Évaluation supprimée avec succès.";
                break;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Erreur : " . $e->getMessage();
    }

    header("Location: listeEvaluations");
    exit;
}
?>

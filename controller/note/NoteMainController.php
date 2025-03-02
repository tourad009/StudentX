<?php
require_once "NoteController.php";
require_once "../../model/StudentRepository.php";
require_once "../../model/EvaluationRepository.php";
require_once "../../model/NoteRepository.php";

session_start();

$controller = new NoteController();
$studentRepo = new StudentRepository();
$evalRepo = new EvaluationRepository();
$noteRepo = new NoteRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    try {
        switch ($_POST['action']) {
            case 'ajouter':
                // Récupérer l'ID de l'étudiant à partir du matricule
                $etudiant_id = $controller->getRepository()->getIdEtudiantByMatricule($_POST['matricule']);
                if (!$etudiant_id) {
                    $_SESSION['error_message'] = "Étudiant non trouvé avec ce matricule.";
                    header("Location: listeNotes");
                    exit;
                }

                // Récupérer l'ID de l'évaluation à partir du nom
                $evaluation_id = $controller->getRepository()->getIdEvaluationByName($_POST['evaluation']);
                if (!$evaluation_id) {
                    $_SESSION['error_message'] = "Évaluation non trouvée avec ce nom.";
                    header("Location: listeNotes");
                    exit;
                }

                // Ajouter la note
                $controller->getRepository()->add($etudiant_id, $evaluation_id, $_POST['note']);
                $_SESSION['success_message'] = "Note ajoutée avec succès.";
                break;

            case 'modifier':
                $controller->getRepository()->update($_POST['note_id'], $_POST['note']);
                $_SESSION['success_message'] = "Note modifiée avec succès.";
                break;

            case 'supprimer':
                $controller->getRepository()->delete($_POST['note_id']);
                $_SESSION['success_message'] = "Note supprimée avec succès.";
                break;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Erreur : " . $e->getMessage();
    }

    header("Location: listeNotes");
    exit;
}

// Fonctions pour obtenir les IDs
function getIdEtudiantByMatricule($matricule) {
    // Logique pour obtenir l'ID de l'étudiant à partir du matricule
    // Retourne l'ID ou null si non trouvé
}

function getIdEvaluationByName($evaluation) {
    // Logique pour obtenir l'ID de l'évaluation à partir du nom
    // Retourne l'ID ou null si non trouvé
}
?>

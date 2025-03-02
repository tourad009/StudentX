<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/StudentX/model/NoteRepository.php";

class NoteController {
    private $repository;

    public function __construct() {
        $this->repository = new NoteRepository();
    }

    public function getRepository() {
        return $this->repository;
    }

    public function getAllNotes() {
        try {
            return $this->repository->getAll();
        } catch (Exception $e) {
            error_log("Erreur dans getAllNotes: " . $e->getMessage());
            return [];
        }
    }

    public function getNoteById($id) {
        try {
            return $this->repository->getNoteById($id);
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération de la note: " . $e->getMessage());
            return null;
        }
    }

    public function addNote($note, $idEtudiant, $idEvaluation) {
        try {
            return $this->repository->addNote($note, $idEtudiant, $idEvaluation);
        } catch (Exception $e) {
            error_log("Erreur lors de l'ajout de la note: " . $e->getMessage());
            return false;
        }
    }

    public function updateNote($id, $note) {
        try {
            return $this->repository->updateNote($id, $note);
        } catch (Exception $e) {
            error_log("Erreur lors de la mise à jour de la note: " . $e->getMessage());
            return false;
        }
    }

    public function deleteNote($id) {
        try {
            return $this->repository->deleteNote($id);
        } catch (Exception $e) {
            error_log("Erreur lors de la suppression de la note: " . $e->getMessage());
            return false;
        }
    }
}
?>

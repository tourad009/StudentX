<?php
require_once "../../model/NoteRepository.php";

class NoteController {
    private $repository;

    public function __construct() {
        $this->repository = new NoteRepository();
    }

    public function listNotes() {
        return $this->repository->getAllNotes();
    }

    public function getNoteById($id) {
        return $this->repository->getNoteById($id);
    }

    public function addNote($note, $idEtudiant, $idEvaluation) {
        return $this->repository->addNote($note, $idEtudiant, $idEvaluation);
    }

    public function updateNote($id, $note) {
        return $this->repository->updateNote($id, $note);
    }

    public function deleteNote($id) {
        return $this->repository->deleteNote($id);
    }
}
?>

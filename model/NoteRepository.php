<?php
require_once "DBRepository.php";

class NoteRepository extends DBRepository {

    public function getAllNotes() {
        $query = "SELECT n.id, e.matricule, ev.nom AS evaluation, n.note 
                  FROM note n 
                  JOIN etudiants e ON n.idEtudiant = e.id
                  JOIN evaluation ev ON n.idEvaluation = ev.id";
        return $this->fetchAll($query);
    }

    public function getNoteById($id) {
        $query = "SELECT * FROM note WHERE id = ?";
        return $this->fetchOne($query, [$id]);
    }

    public function addNote($idEtudiant, $idEvaluation, $note) {
        $query = "INSERT INTO note (idEtudiant, idEvaluation, note) VALUES (?, ?, ?)";
        return $this->execute($query, [$idEtudiant, $idEvaluation, $note]);
    }

    public function updateNote($id, $idEtudiant, $idEvaluation, $note) {
        $query = "UPDATE note SET idEtudiant = ?, idEvaluation = ?, note = ? WHERE id = ?";
        return $this->execute($query, [$idEtudiant, $idEvaluation, $note, $id]);
    }

    public function deleteNote($id) {
        $query = "DELETE FROM note WHERE id = ?";
        return $this->execute($query, [$id]);
    }
}
?>

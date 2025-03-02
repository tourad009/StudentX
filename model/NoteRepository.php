<?php
require_once "DBRepository.php";

class NoteRepository extends DBRepository {

    public function getAll() {
        try {
            $sql = "SELECT n.note_id, n.note, 
                           e.matricule,
                           ev.nom as evaluation_nom
                    FROM notes n
                    JOIN etudiants e ON n.etudiant_id = e.etudiant_id
                    JOIN evaluations ev ON n.evaluation_id = ev.evaluation_id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des notes: " . $e->getMessage());
            throw $e;
        }
    }

    public function getNoteById($id) {
        $query = "SELECT * FROM note WHERE id = ?";
        try {
            return $this->fetchOne($query, [$id]);
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération de la note d'ID $id: " . $error->getMessage());
            throw $error;
        }
    }

    public function add($etudiant_id, $evaluation_id, $note) {
        try {
            $sql = "INSERT INTO notes (etudiant_id, evaluation_id, note) 
                    VALUES (:etudiant_id, :evaluation_id, :note)";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'etudiant_id' => $etudiant_id,
                'evaluation_id' => $evaluation_id,
                'note' => $note
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la note: " . $e->getMessage());
            throw $e;
        }
    }

    public function update($note_id, $note) {
        try {
            $sql = "UPDATE notes 
                    SET note = :note 
                    WHERE note_id = :note_id";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'note_id' => $note_id,
                'note' => $note
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la modification de la note: " . $e->getMessage());
            throw $e;
        }
    }

    public function delete($note_id) {
        try {
            $sql = "DELETE FROM notes WHERE note_id = :note_id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['note_id' => $note_id]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression de la note: " . $e->getMessage());
            throw $e;
        }
    }

    public function getIdEtudiantByMatricule($matricule) {
        try {
            $sql = "SELECT etudiant_id FROM etudiants WHERE matricule = :matricule";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['matricule' => $matricule]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['etudiant_id'] : null;
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération de l'ID étudiant: " . $e->getMessage());
            throw $e;
        }
    }

    public function getIdEvaluationByName($nom) {
        try {
            $sql = "SELECT evaluation_id FROM evaluations WHERE nom = :nom";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['nom' => $nom]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['evaluation_id'] : null;
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération de l'ID évaluation: " . $e->getMessage());
            throw $e;
        }
    }
}
?>

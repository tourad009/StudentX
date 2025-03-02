<?php
require_once "DBRepository.php";

class EvaluationRepository extends DBRepository {
    public function getAll() {
        try {
            $sql = "SELECT evaluation_id, nom, semestre, type FROM evaluations";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des évaluations: " . $e->getMessage());
            throw $e;
        }
    }

    public function getByName($nom) {
        try {
            $sql = "SELECT evaluation_id, nom, semestre, type 
                    FROM evaluations 
                    WHERE nom = :nom";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['nom' => $nom]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la recherche de l'évaluation: " . $e->getMessage());
            throw $e;
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT evaluation_id, nom, semestre, type 
                    FROM evaluations 
                    WHERE evaluation_id = :id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération de l'évaluation: " . $e->getMessage());
            throw $e;
        }
    }

    public function add($nom, $semestre, $type) {
        try {
            $sql = "INSERT INTO evaluations (nom, semestre, type) VALUES (:nom, :semestre, :type)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'nom' => $nom,
                'semestre' => $semestre,
                'type' => $type
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de l'évaluation: " . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, $nom, $semestre, $type) {
        try {
            $sql = "UPDATE evaluations 
                    SET nom = :nom, 
                        semestre = :semestre, 
                        type = :type 
                    WHERE evaluation_id = :id";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'nom' => $nom,
                'semestre' => $semestre,
                'type' => $type
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la modification de l'évaluation: " . $e->getMessage());
            throw $e;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM evaluations WHERE evaluation_id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression de l'évaluation: " . $e->getMessage());
            throw $e;
        }
    }
}
?> 
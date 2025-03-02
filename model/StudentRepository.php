<?php
require_once "UserRepository.php";

class StudentRepository extends UserRepository {

    // Récupérer tous les étudiants
    public function getAllStudents() {
        $query = "SELECT * FROM etudiants";
        return $this->fetchAll($query);
    }

    // Récupérer un étudiant par son ID
    public function getStudentById($id) {
        $query = "SELECT * FROM etudiants WHERE etudiant_id = ?";
        return $this->fetchOne($query, [$id]);
    }

    // Ajouter un étudiant
    public function addStudent($userId, $matricule, $tel, $adresse, $createdBy) {
        // Préparer la requête d'insertion dans la table etudiants
        $sql = "INSERT INTO etudiants (user_id, matricule, tel, adresse, created_by, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("issss", $userId, $matricule, $tel, $adresse, $createdBy);
        
        // Exécuter la requête
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'ajout de l'étudiant.");
        }
    }

    // Mettre à jour un étudiant
    public function updateStudent($id, $nom, $email, $matricule, $tel, $adresse) {
        $query = "UPDATE etudiants 
                  SET nom = ?, email = ?, matricule = ?, tel = ?, adresse = ? 
                  WHERE etudiant_id = ?";
        return $this->execute($query, [$nom, $email, $matricule, $tel, $adresse, $id]);
    }

    // Supprimer un étudiant
    public function deleteStudent($id) {
        $query = "DELETE FROM etudiants WHERE etudiant_id = ?";
        return $this->execute($query, [$id]);
    }

    // Activer un étudiant
    public function activateStudent($id) {
        $query = "UPDATE etudiants SET active = 1 WHERE etudiant_id = ?";
        return $this->execute($query, [$id]);
    }

    // Désactiver un étudiant
    public function deactivateStudent($id) {
        $query = "UPDATE etudiants SET active = 0 WHERE etudiant_id = ?";
        return $this->execute($query, [$id]);
    }
}
?>

<?php
require_once "DBRepository.php";

class StudentRepository extends DBRepository {

    // Récupérer tous les étudiants
    public function getAllStudents() {
        try {
            $sql = "SELECT 
                    u.user_id,
                    u.nom,
                    u.prenom,
                    u.email,
                    u.etat,
                    e.matricule,
                    e.tel,
                    e.adresse
                FROM users u
                INNER JOIN etudiants e ON u.user_id = e.user_id
                WHERE u.etat = 1 
                AND u.role = 'Etudiant'
                ORDER BY u.nom, u.prenom";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            // Débogage
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Nombre d'étudiants trouvés : " . count($result));
            return $result;
            
        } catch (PDOException $e) {
            error_log("Erreur dans getAllStudents: " . $e->getMessage());
            throw $e;
        }
    }

    // Récupérer un étudiant par son ID
    public function getStudentById($id) {
        try {
            $sql = "SELECT 
                    u.user_id,
                    u.nom,
                    u.prenom,
                    u.email,
                    u.etat,
                    e.matricule,
                    e.tel,
                    e.adresse
                FROM users u
                INNER JOIN etudiants e ON u.user_id = e.user_id
                WHERE u.user_id = :id 
                AND u.etat = 1
                AND u.role = 'Etudiant'";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération de l'étudiant: " . $e->getMessage());
            throw $e;
        }
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

    public function getByMatricule($matricule) {
        try {
            $sql = "SELECT e.*, u.nom, u.prenom 
                    FROM etudiants e 
                    JOIN users u ON e.user_id = u.user_id 
                    WHERE e.matricule = :matricule AND u.etat = 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['matricule' => $matricule]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la recherche de l'étudiant: " . $e->getMessage());
            throw $e;
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT e.*, u.nom, u.prenom 
                    FROM etudiants e 
                    JOIN users u ON e.user_id = u.user_id 
                    WHERE e.id = :id AND u.etat = 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération de l'étudiant: " . $e->getMessage());
            throw $e;
        }
    }
}
?>

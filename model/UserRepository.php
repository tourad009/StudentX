<?php

require_once("DBRepository.php");

class UserRepository extends DBRepository
{
    // ==================== MÉTHODES D'AUTHENTIFICATION ====================
    
    // Connexion de l'utilisateur
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['email' => $email]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            error_log("Tentative de connexion pour l'email: $email");
            if ($user) {
                error_log("Utilisateur trouvé: " . print_r($user, true));
            } else {
                error_log("Aucun utilisateur trouvé avec cet email");
            }

            if ($user && password_verify($password, $user['password'])) {
                error_log("Mot de passe vérifié avec succès");
                // L'utilisateur est authentifié, on stocke ses informations dans la session
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();  // Démarre la session si elle n'est pas déjà démarrée
                }
                $_SESSION['user_id'] = $user['user_id'];  // Stocke l'ID de l'utilisateur dans la session
                $_SESSION['user_role'] = $user['role'];  // Stocke le rôle de l'utilisateur dans la session
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['etat'] = $user['etat'];
                $_SESSION['photo'] = $user['photo'] ?? 'default.png';

                error_log("Session après connexion: " . print_r($_SESSION, true));
                return $user;
            }
            return false;
        } catch (PDOException $error) {
            error_log("Erreur lors de la connexion de l'utilisateur: " . $error->getMessage());
            throw $error;
        }
    }
    
    // ==================== MÉTHODES DE RÉCUPÉRATION ====================
    
    // Récupérer la liste des utilisateurs
    public function getAll(int $etat, string $role = null)
    {
        try {
            // Sélectionner uniquement les colonnes existantes dans la table users
            $sql = "SELECT u.user_id as id, u.nom, u.prenom, u.email, u.role, u.etat 
                    FROM users u 
                    WHERE u.etat = :etat ";

            if ($role) {
                $sql .= "AND u.role = :role";
            }

            $statement = $this->db->prepare($sql);
            $params = ['etat' => $etat];
            
            if ($role) {
                $params['role'] = $role;
            }

            $statement->execute($params);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // Vérifier si des résultats ont été trouvés
            if (empty($results)) {
                error_log("Aucun utilisateur trouvé avec etat=$etat" . ($role ? " et role=$role" : ""));
                return [];
            }
            
            // Débogage pour voir la structure exacte des données retournées
            if (!empty($results)) {
                error_log("Structure des données retournées par getAll: " . print_r($results[0], true));
            }
            
            return $results;

        } catch (PDOException $error) {
            $etatLabel = $etat == 1 ? "actives" : "supprimés";
            error_log("Erreur lors de la récupération des utilisateurs $etatLabel: " . $error->getMessage());
            throw $error;
        }
    }

    // Récupérer un utilisateur via son ID
    public function getById(int $id)
    {
        try {
            // Utiliser directement user_id comme nom de colonne pour l'identifiant
            $sql = "SELECT * FROM users WHERE user_id = :id";

            $statement = $this->db->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            
            // Assurez-vous que l'ID est accessible via la clé 'id' pour la compatibilité
            if ($user && !isset($user['id']) && isset($user['user_id'])) {
                $user['id'] = $user['user_id'];
            }
            
            return $user ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération de l'utilisateur d'id $id: " . $error->getMessage());
            throw $error;
        }
    }

    // Récupérer un utilisateur via son email
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['email' => $email]);
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération de l'utilisateur d'email $email: " . $error->getMessage());
            throw $error;
        }
    }
    
    // Récupérer un utilisateur via son ID (alias pour getById pour compatibilité)
    public function getUserById($userId)
    {
        return $this->getById($userId);
    }
    
    // ==================== MÉTHODES DE VÉRIFICATION ====================
    
    // Vérifier si l'email existe déjà
    public function checkEmailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['email' => $email]);
            return $statement->fetchColumn() > 0; // Retourne true si l'email existe déjà
        } catch (PDOException $error) {
            error_log("Erreur lors de la vérification de l'email : " . $error->getMessage());
            throw $error;
        }
    }
    
    // ==================== MÉTHODES DE CRÉATION ET MODIFICATION ====================
    
    // Permet de créer un compte utilisateur
    public function register($nom, $adresse, $telephone, $photo, $email, $password, $role, $createdBy)
    {
        $sql = "INSERT INTO users (nom, adresse, telephone, photo, email, password, role, etat, created_at, created_by)
                VALUES (:nom, :adresse, :telephone, :photo, :email, :password, :role, default, NOW(), :created_by)";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'adresse' => $adresse,
                'telephone' => $telephone,
                'photo' => $photo,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'created_by' => $createdBy
            ]);

            $lastInsertId = $this->db->lastInsertId();
            return $lastInsertId ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la création de compte utilisateur " . $error->getMessage());
            throw $error;
        }
    }

    // Ajouter un nouvel utilisateur
    public function addUser($nom, $prenom, $email, $role, $password, $createdBy = 11, $matricule = null, $tel = null, $adresse = null) {
        if (empty($password)) {
            throw new Exception("Le mot de passe ne peut pas être vide.");
        }

        // Hashage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 1. Ajouter l'utilisateur dans la table `users` sans `created_at` ni `created_by`
        $query = "INSERT INTO users (nom, prenom, email, role, password, etat) 
                VALUES (:nom, :prenom, :email, :role, :password, 1)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':password', $hashedPassword); // Utilisation du mot de passe haché
        
        $stmt->execute(); // Exécute l'ajout dans la table `users`
        
        // Récupérer l'ID de l'utilisateur ajouté
        $userId = $this->db->lastInsertId();

        // 2. Ajouter l'utilisateur dans la table `etudiants` si le rôle est "Etudiant"
        if ($role === 'Etudiant') {
            if (empty($matricule) || empty($tel) || empty($adresse)) {
                throw new Exception("Les informations de l'étudiant (matricule, téléphone, adresse) sont obligatoires.");
            }

            $queryEtudiant = "INSERT INTO etudiants (user_id, matricule, tel, adresse, created_by, created_at) 
                            VALUES (:user_id, :matricule, :tel, :adresse, :created_by, NOW())";
            
            $stmtEtudiant = $this->db->prepare($queryEtudiant);
            $stmtEtudiant->bindParam(':user_id', $userId);
            $stmtEtudiant->bindParam(':matricule', $matricule);
            $stmtEtudiant->bindParam(':tel', $tel);
            $stmtEtudiant->bindParam(':adresse', $adresse);
            $stmtEtudiant->bindParam(':created_by', $createdBy);
            
            $stmtEtudiant->execute(); // Exécute l'ajout dans la table `etudiants`
        }

        // 3. Ajouter l'utilisateur dans la table `admins` si le rôle est "Admin"
        if ($role === 'Admin') {
            // Ajustement : on insère seulement user_id dans la table admins
            $queryAdmin = "INSERT INTO admins (user_id) 
                           VALUES (:user_id)";
            
            $stmtAdmin = $this->db->prepare($queryAdmin);
            $stmtAdmin->bindParam(':user_id', $userId);
            
            $stmtAdmin->execute(); // Exécute l'ajout dans la table `admins`
        }

        return $userId; // Retourne l'ID de l'utilisateur ajouté
    }

    // Éditer un utilisateur
    public function editUser($id, $nom, $prenom, $email, $password = null, $matricule = null, $tel = null, $adresse = null) {
        try {
            $this->db->beginTransaction();

            // 1. Mise à jour de la table users
            if ($password) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users 
                        SET nom = :nom, 
                            prenom = :prenom, 
                            email = :email, 
                            password = :password 
                        WHERE user_id = :id";
                
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':password', $hashedPassword);
            } else {
                $sql = "UPDATE users 
                        SET nom = :nom, 
                            prenom = :prenom, 
                            email = :email 
                        WHERE user_id = :id";
                
                $stmt = $this->db->prepare($sql);
            }

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // 2. Mise à jour de la table etudiants si l'utilisateur est un étudiant
            if ($matricule !== null || $tel !== null || $adresse !== null) {
                $sql = "UPDATE etudiants 
                        SET matricule = :matricule,
                            tel = :tel,
                            adresse = :adresse,
                            updated_at = CURRENT_TIMESTAMP
                        WHERE user_id = :user_id";
                
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':matricule', $matricule);
                $stmt->bindParam(':tel', $tel);
                $stmt->bindParam(':adresse', $adresse);
                $stmt->bindParam(':user_id', $id);
                $stmt->execute();
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erreur lors de la modification de l'utilisateur : " . $e->getMessage());
            throw $e;
        }
    }

    // Mettre à jour un utilisateur (méthode générique)
    public function updateUser($id, $data) {
        try {
            $fields = [];
            $params = [];
            
            foreach ($data as $key => $value) {
                if ($value !== null) {
                    $fields[] = "$key = :$key";
                    $params[$key] = $value;
                }
            }
            
            if (empty($fields)) {
                return false; // Rien à mettre à jour
            }
            
            $params['id'] = $id;
            $params['updated_at'] = date('Y-m-d H:i:s');
            
            $query = "UPDATE users SET " . implode(', ', $fields) . ", updated_at = :updated_at WHERE user_id = :id";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erreur lors de la mise à jour de l'utilisateur: " . $e->getMessage());
            throw $e;
        }
    }

    // Mettre à jour un étudiant
    public function updateEtudiantDetails($id, $matricule, $tel, $adresse) {
        try {
            // Construire la requête de mise à jour pour les détails étudiants
            $query = "UPDATE etudiants SET matricule = :matricule, tel = :tel, adresse = :adresse, updated_at = NOW(), updated_by = 11 WHERE user_id = :id";
    
            $stmt = $this->db->prepare($query);
    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':matricule', $matricule);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':adresse', $adresse);
    
            // Exécution de la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur lors de la mise à jour des détails étudiant: " . $e->getMessage());
            throw $e;
        }
    }
    
    // ==================== MÉTHODES DE SUPPRESSION ET ACTIVATION ====================

    // Désactiver un utilisateur
    public function desactivate($id)
    {
        // Vérifier si la session est démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Session utilisateur non trouvée.");
        }
        
        $deletedBy = $_SESSION['user_id']; // ID de l'utilisateur qui effectue l'action

        $sql = "UPDATE users SET etat = 0, deleted_at = NOW(), deleted_by = :deleted_by WHERE user_id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['deleted_by' => $deletedBy, 'id' => $id]);

            return $statement->rowCount() > 0; // Retourne true si au moins une ligne est affectée
        } catch (PDOException $error) {
            error_log("Erreur lors de la désactivation de l'utilisateur d'ID $id: " . $error->getMessage());
            throw $error;
        }
    }

    // Activer un utilisateur
    public function activate($id)
    {
        // Vérifier si la session est démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Session utilisateur non trouvée.");
        }
        
        $updatedBy = $_SESSION['user_id']; // ID de l'utilisateur qui effectue l'action

        // Vérifier si l'utilisateur est déjà actif pour éviter une mise à jour inutile
        $checkSql = "SELECT etat FROM users WHERE user_id = :id";
        $checkStmt = $this->db->prepare($checkSql);
        $checkStmt->execute(['id' => $id]);
        $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            error_log("Utilisateur d'ID $id introuvable.");
            return false; // L'utilisateur n'existe pas
        }

        if ($user['etat'] == 1) {
            return true; // L'utilisateur est déjà actif, pas besoin de mise à jour
        }

        // Activation de l'utilisateur
        $sql = "UPDATE users SET etat = 1, updated_at = NOW(), updated_by = :updated_by WHERE user_id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['updated_by' => $updatedBy, 'id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de l'activation de l'utilisateur d'ID $id: " . $error->getMessage());
            throw $error;
        }
    }

    // Supprimer un utilisateur
    public function deleteUser($id, $deletedBy = null)
    {
        try {
            // Commencer une transaction pour assurer l'intégrité des données
            $this->db->beginTransaction();
            
            // D'abord supprimer les enregistrements liés dans les tables enfants
            // Supprimer de la table etudiants si l'utilisateur est un étudiant
            $sqlEtudiant = "DELETE FROM etudiants WHERE user_id = :id";
            $stmtEtudiant = $this->db->prepare($sqlEtudiant);
            $stmtEtudiant->execute(['id' => $id]);
            
            // Supprimer de la table admins si l'utilisateur est un admin
            $sqlAdmin = "DELETE FROM admins WHERE user_id = :id";
            $stmtAdmin = $this->db->prepare($sqlAdmin);
            $stmtAdmin->execute(['id' => $id]);
            
            // Enfin, supprimer l'utilisateur lui-même
            $sql = "DELETE FROM users WHERE user_id = :id";
            $statement = $this->db->prepare($sql);
            $statement->execute(['id' => $id]);
            
            // Valider la transaction
            $this->db->commit();
            
            return true;
        } catch (PDOException $error) {
            // Annuler la transaction en cas d'erreur
            $this->db->rollBack();
            error_log("Erreur lors de la suppression de l'utilisateur d'id $id: " . $error->getMessage());
            throw new Exception("Erreur lors de la suppression de l'utilisateur: " . $error->getMessage());
        }
    }
    
    // ==================== MÉTHODES DE GESTION DE MOT DE PASSE ====================

    // Mettre à jour le mot de passe
    public function updatePassword($userId, $hashedPassword)
    {
        $sql = "UPDATE users SET password = :password, updated_at = NOW(), updated_by = :updated_by WHERE user_id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'password' => $hashedPassword,
                'updated_by' => $userId,
                'id' => $userId
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification du mot de passe: " . $error->getMessage());
            throw $error;
        }
    }

    // Méthode pour créer un utilisateur de test (à utiliser uniquement pour le développement)
    public function createTestAdmin()
    {
        try {
            // Vérifier si l'utilisateur existe déjà
            $checkSql = "SELECT COUNT(*) FROM users WHERE email = 'admin@test.com'";
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->execute();
            $exists = $checkStmt->fetchColumn() > 0;
            
            if (!$exists) {
                // Créer l'utilisateur admin de test
                $hashedPassword = password_hash('password123', PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (nom, prenom, email, role, password, etat, created_at) 
                        VALUES ('Admin', 'Test', 'admin@test.com', 'Admin', :password, 1, NOW())";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();
                
                $userId = $this->db->lastInsertId();
                
                // Ajouter dans la table admins
                $adminSql = "INSERT INTO admins (user_id) VALUES (:user_id)";
                $adminStmt = $this->db->prepare($adminSql);
                $adminStmt->bindParam(':user_id', $userId);
                $adminStmt->execute();
                
                return "Utilisateur admin de test créé avec succès. Email: admin@test.com, Mot de passe: password123";
            }
            
            return "L'utilisateur admin de test existe déjà.";
        } catch (PDOException $e) {
            return "Erreur lors de la création de l'utilisateur de test: " . $e->getMessage();
        }
    }
}
?>

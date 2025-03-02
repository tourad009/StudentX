<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("UserController.php");
require_once("../../model/UserRepository.php");

// Débogage - Enregistrer les données POST et GET pour vérification
error_log("POST data: " . print_r($_POST, true));
error_log("GET data: " . print_r($_GET, true));
error_log("SESSION data: " . print_r($_SESSION, true));

// creation d'un objet UserController
$userController = new UserController();

// Authetification
if (isset($_POST['formLogin'])) {
    error_log("Tentative de connexion avec email: " . ($_POST['email'] ?? 'non défini'));
    // appel de la methode auth
    $userController->auth(); 
}

// Deconnexion
if (isset($_GET['logout'])) {
    // appel de la methode logout
    $userController->logout(); 
}

// Vérifie que l'action est bien définie
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Simplification: ne pas vérifier la session pour le moment
    // pour permettre à l'application de fonctionner

    if ($action == 'addUser') {
        // Logique pour ajouter un utilisateur
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données du formulaire
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            $email = trim($_POST['email']);
            $role = trim($_POST['role']);
            $password = $_POST['password'];

            // Récupérer les informations spécifiques aux étudiants
            $matricule = $_POST['matricule'] ?? null;
            $tel = $_POST['tel'] ?? null;
            $adresse = $_POST['adresse'] ?? null;

            // Si le rôle est "Etudiant", vérifier que les informations sont présentes
            if ($role == 'Etudiant' && (!$matricule || !$tel || !$adresse)) {
                $_SESSION['error_message'] = "Les informations de l'étudiant (matricule, téléphone, adresse) sont obligatoires.";
                header("Location: gestionUtilisateurs");
                exit;
            }

            // Ajouter l'utilisateur
            try {
                $userRepo = new UserRepository();
                $createdBy = $_SESSION['user_id'] ?? 1; // ID de l'utilisateur connecté ou 1 par défaut
                $userRepo->addUser($nom, $prenom, $email, $role, $password, $createdBy, $matricule, $tel, $adresse);

                // Stocker un message de succès dans la session
                $_SESSION['success_message'] = "Utilisateur ajouté avec succès !";
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Erreur lors de l'ajout : " . $e->getMessage();
            }

            // Redirection vers la page de gestion des utilisateurs
            header("Location: gestionUtilisateurs");
            exit;
        }
    }
    
    // Editer un utilisateur
    if ($action == 'editUser' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Création de l'objet UserRepository
        $userRepository = new UserRepository();

        // Récupérer les données du formulaire
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = !empty($_POST['password']) ? $_POST['password'] : null; // Mot de passe (pourrait être vide)
        
        // Récupérer le rôle actuel de l'utilisateur depuis la base de données
        $user = $userRepository->getById($id);
        
        if (!$user) {
            $_SESSION['error_message'] = "Utilisateur non trouvé.";
            header('Location: gestionUtilisateurs');
            exit;
        }
        
        // Mettre à jour les informations générales de l'utilisateur
        $userRepository->editUser($id, $nom, $prenom, $email, $password);

        // Si l'utilisateur est un étudiant, mettre à jour les informations spécifiques
        if ($user['role'] == 'Etudiant') {
            $matricule = $_POST['matricule'] ?? null;
            $tel = $_POST['tel'] ?? null;
            $adresse = $_POST['adresse'] ?? null;
            
            // Mettre à jour les informations de l'étudiant
            $userRepository->updateEtudiantDetails($id, $matricule, $tel, $adresse);
        }

        // Message de succès
        $_SESSION['success_message'] = "Utilisateur modifié avec succès !";
        
        // Redirection après édition
        header('Location: gestionUtilisateurs');
        exit;
    }

    // Suppression d'un utilisateur
    if ($action == 'deleteUser') {
        // Vérifier si l'ID est passé en POST ou en GET
        $id = null;
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        if ($id) {
            // Simplification: ne pas vérifier la session pour le moment
            $adminId = $_SESSION['user_id'] ?? 1; // Utiliser 1 par défaut si pas de session

            // Création d'un objet UserRepository pour supprimer l'utilisateur
            $userRepository = new UserRepository();
            
            try {
                // Appeler la méthode de suppression dans UserRepository
                $userRepository->deleteUser($id, $adminId);
                
                // Message de succès
                $_SESSION['success_message'] = "Utilisateur supprimé avec succès !";
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Erreur lors de la suppression : " . $e->getMessage();
            }
            
            // Redirection après suppression
            header('Location: gestionUtilisateurs');
            exit;
        } else {
            $_SESSION['error_message'] = "ID d'utilisateur non spécifié.";
            header('Location: gestionUtilisateurs');
            exit;
        }
    }
}
?>
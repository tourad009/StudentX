<?php
require_once('../model/UserRepository.php');

header('Content-Type: application/json');

try {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    
    $errors = [];
    
    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format d\'email invalide';
    }
    
    // Validation du mot de passe
    if (empty($password)) {
        $errors['password'] = 'Le mot de passe est requis';
    }
    
    // S'il y a des erreurs, les renvoyer
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => 'Veuillez corriger les erreurs',
            'errors' => $errors
        ]);
        exit;
    }
    
    $userRepo = new UserRepository();
    $user = $userRepo->login($email, $password);
    
    if ($user) {
        echo json_encode([
            'success' => true,
            'message' => 'Connexion réussie'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Email ou mot de passe incorrect'
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} 